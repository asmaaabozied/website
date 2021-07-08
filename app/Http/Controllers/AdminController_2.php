<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '3000M');
ini_set('max_execution_time', '0');
use Illuminate\Http\Request;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;

use App\Googl;
use Carbon\Carbon;
use DB;
class AdminController_2 extends Controller
{
    private $client;
    private $drive;

    public function __construct(Googl $googl)
    {

   		$this->client = $googl->client();

		$this->client->setAccessToken(session('user.token'));

   		$this->drive = $googl->drive($this->client);

    }



    public function index()
    {
        return view('admin_2.admin.dashboard');
    }




   	public function files()
   	{
		$result = [];
		$pageToken = NULL;

		$three_months_ago = Carbon::now()->subMonths(3)->toRfc3339String();

		do {
			try {
				$parameters = [
					'q' => "viewedByMeTime >= '$three_months_ago' or modifiedTime >= '$three_months_ago'",
					'orderBy' => 'modifiedTime',
                    'fields' => 'nextPageToken, files(id, name, modifiedTime, iconLink, webViewLink, webContentLink)',
				];

				if ($pageToken) {
					$parameters['pageToken'] = $pageToken;
				}

				$result = $this->drive->files->listFiles($parameters);
                $files = $result->files;

				$pageToken = $result->getNextPageToken();

			} catch (Exception $e) {
			  	return redirect('/files')->with('message',
			  		[
						'type' => 'error',
						'text' => 'Something went wrong while trying to list the files'
			  		]
			  	);
			    $pageToken = NULL;
			}
		} while ($pageToken);

		$page_data = [
			'files' => $files
		];

		return view('admin_2.admin.files', $page_data);
   }


   	public function search(Request $request)
   	{
   		$query = '';
   		$files = [];

   		if ($request->has('query')) {
	   		$query = $request->input('query');

	   		$parameters = [
	   			'q' => "name contains '$query'",
                'fields' => 'files(id, name, modifiedTime, iconLink, webViewLink, webContentLink)',
	   		];

	   		$result = $this->drive->files->listFiles($parameters);
            if($result){
                $files = $result->files;
            }
   		}

   		$page_data = [
   			'query' => $query,
   			'files' => $files
   		];

   		return view('admin_2.admin.search', $page_data);
   }


    public function delete($id)
    {
		try {
			$this->drive->files->delete($id);
		} catch (Exception $e) {
			return redirect('/search')
				->with('message', [
					'type' => 'error',
					'text' => 'Something went wrong while trying to delete the file'
				]);
		}

		return redirect('/search')
			->with('message', [
				'type' => 'success',
				'text' => 'File was deleted'
			]);
   }

	public function doCopy2($id)
    {
        ini_set('memory_limit', '-1');
		$file_name = '';
		$now = new \DateTime();
		$cyear = $now->format('Y');
		$cmonth = $now->format('m');
	
		try {
			
			$drive_file = new \Google_Service_Drive_DriveFile();
			
			$parameters = [
	   			
                'fields' => 'files(id, name, modifiedTime, iconLink, webViewLink, webContentLink)',
	   		];

	   		$result = $this->drive->files->listFiles($parameters);
			//$drive_file = $this->drive->files->get($id);
			
			//echo count ($result);
			
			$files = array ();
			if ( count ($result) != 0 )
			{
				$files = $result->files;
			}
            
			foreach($files as $file)
			{
				$drive_file  = $file ;
				
				if ( $drive_file->id == $id )
				{
					
					break;
				}
				
			}
            
			
			$response = $this->drive->files->get($id, array(  'alt' => 'media' ));
			$content = $response->getBody()->getContents();
            $filenameWithoutExtension = pathinfo($drive_file->name, PATHINFO_FILENAME);


			//echo ( $content );
			
            //echo $drive_file->name;
			
			$file_name = $cyear . '/' . $cmonth . '/' . $drive_file->name;
            $file_name_conversion = '/uploads/' . $cyear . '/' . $cmonth . '/conversion/'. $filenameWithoutExtension.'.mkv';

            //$destinationPath = 'videos/google/'.$drive_file->name ;
			//Storage::disk('uploads')->put( $destinationPath , $content );
			
			
			$destinationPath = 'uploads/' . $cyear . '/' . $cmonth . '/';
			$destinationConversionPath = 'uploads/' . $cyear . '/' . $cmonth . '/conversion/';
			Storage::disk('public')->put( $destinationPath .$drive_file->name ,
					$content );


            set_time_limit(-1);

            $format = new \FFMpeg\Format\Video\X264();
            $format->setAudioCodec("libmp3lame");

            \FFMpeg::fromDisk('public')
                ->open($destinationPath .$drive_file->name)
                ->addFilter(function ($filters) {

                    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));

                })
                ->export()
                ->toDisk('videos_ftp')
                ->inFormat($format)
                ->save($destinationConversionPath .$filenameWithoutExtension.'.mkv');


		} catch (Exception $e) {
			echo $e ;
		}
		
		$page_data = [
			'file_name' => $file_name_conversion
		];
        Storage::disk('public')->delete($destinationPath .$drive_file->name);

		return view('admin_2.admin.done', $page_data);
		
   }
   

   	public function upload()
   	{
    	return view('admin_2.admin.upload');
   	}


   	public function doUpload(Request $request)
    {
		if ($request->hasFile('file')) {

		  	$file = $request->file('file');

			$mime_type = $file->getMimeType();
			$title = $file->getClientOriginalName();
			$description = $request->input('description');

			$drive_file = new \Google_Service_Drive_DriveFile();
			$drive_file->setName($title);
			$drive_file->setDescription($description);
			$drive_file->setMimeType($mime_type);

			try {
				$createdFile = $this->drive->files->create($drive_file, [
					'data' => $file,
					'mimeType' => $mime_type,
					'uploadType' => 'multipart'
				]);

				$file_id = $createdFile->getId();

				return redirect('/upload')
					->with('message', [
						'type' => 'success',
						'text' => "File was uploaded with the following ID: {$file_id}"
				]);

			} catch (Exception $e) {

			    return redirect('/upload')
    				->with('message', [
    					'type' => 'error',
    					'text' => 'An error occured while trying to upload the file'
    				]);

			}
		}

   }

	public function doCopy(Request $request)
    {
		if ($request->hasFile('file')) {

		  	$file = $request->file('file');

			$mime_type = $file->getMimeType();
			$title = $file->getClientOriginalName();
			$description = $request->input('description');

			$drive_file = new \Google_Service_Drive_DriveFile();
			$drive_file->setName($title);
			$drive_file->setDescription($description);
			$drive_file->setMimeType($mime_type);

			try {
				$createdFile = $this->drive->files->create($drive_file, [
					'data' => $file,
					'mimeType' => $mime_type,
					'uploadType' => 'multipart'
				]);

				$file_id = $createdFile->getId();

				return redirect('/upload')
					->with('message', [
						'type' => 'success',
						'text' => "File was uploaded with the following ID: {$file_id}"
				]);

			} catch (Exception $e) {

			    return redirect('/upload')
    				->with('message', [
    					'type' => 'error',
    					'text' => 'An error occured while trying to upload the file'
    				]);

			}
		}

   }
   
   	public function logout(Request $request)
   	{
   		$request->session()->flush();
   		return redirect('/google')->with('message', ['type' => 'success', 'text' => 'You are now logged out']);
   	}

}
