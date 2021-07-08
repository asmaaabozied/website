<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNotificationRequest;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Notification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OneSignal;

class NotificationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notifications = Notification::all();

        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notifications.create');
    }

    public function store(StoreNotificationRequest $request)
    {
        $notification = Notification::create($request->all());
        if (isset($request->alert_type)) {
            $data = array(
                'media_id' => $request->media_number,
                'media_type' => $request->alert_type,
                'headings' => $request->alert_text,
                'large_icon' => $request->attachments_message,
                'ios_attachments' => $request->attachments_message
            );
            // str_limit($message_content, $limit = 50, $end = '...')
            $success = OneSignal::sendNotificationToAll($request->message_details, $request->link, $data);
        } else {
            $error = OneSignal::sendNotificationToAll($request->message_details, $request->link);
        }

        return redirect()->back();
    }

    public function edit(Notification $notification)
    {
        abort_if(Gate::denies('notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->all());

        return redirect()->route('admin.notifications.index');
    }

    public function show(Notification $notification)
    {
        abort_if(Gate::denies('notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.notifications.show', compact('notification'));
    }

    public function destroy(Notification $notification)
    {
        abort_if(Gate::denies('notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification->delete();

        return back();
    }

    public function massDestroy(MassDestroyNotificationRequest $request)
    {
        Notification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
