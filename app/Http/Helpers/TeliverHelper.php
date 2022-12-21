<?php

namespace App\Http\Helpers;

class TeliverHelper
{

    public static function createPickupTask($id, $donatedBy, $long, $lat, $name, $address, $phone)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/task/create?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "pickup": {
                "lnglat": [
                    ' . $long . ',
                    ' . $lat . '
                ],
                "address": "' . $address . '",
                "customer": {
                    "name": "' . $name . '",
                    "mobile": "' . $phone . '"
                }
            },
            "order_id": "' . $id . '",
            "notes": "' . $donatedBy . '",
            "type": 1,
            "auto_assign": false
        }');

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function createDropTask($id, $donatedBy, $long, $lat, $name, $address, $phone)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/task/create?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "drop": {
                "lnglat": [
                    ' . $long . ',
                    ' . $lat . '
                ],
                "address": "' . $address . '",
                "customer": {
                    "name": "' . $name . '",
                    "mobile": "' . $phone . '"
                }
            },
            "order_id": "' . $id . '",
            "notes": "' . $donatedBy . '",
            "type": 2,
            "auto_assign": false
        }');

        // execute!
        $response = curl_exec($ch);

        error_log($response);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function getTasks()
    {
        $ch = curl_init('https://api.teliver.xyz/v1/task/list?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function getTrackingUrlTask($task_id)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/task/trackingurl/' . $task_id . '?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function createDriver($driver_id, $name, $mobile, $email)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/invite_user?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "user_id":"'.$driver_id.'",
            "name":"'.$name.'",
            "mobile":"'.$mobile.'",
            "email":"'.$email.'"
        }');

        // execute!
        $response = curl_exec($ch);

        error_log($response);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function assignDriver($task_id, $driver_id)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/task/assign?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "task_id": "' . $task_id . '",
            "driver_id": "' . $driver_id . '"
        }');

        // execute!
        $response = curl_exec($ch);

        error_log($response);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    public static function getTrackingUrlTrip($trip_id)
    {
        $ch = curl_init('https://api.teliver.xyz/v1/trips/trackingurl/' . $trip_id . '?apikey=b59834bda9874493b8e6af7c3f4a102a');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }
}
