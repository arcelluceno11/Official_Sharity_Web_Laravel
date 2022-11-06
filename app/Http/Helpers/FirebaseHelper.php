<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

class FirebaseHelper {

    public static function uploadFile($file, $storagepath){

        // Uploading the photo to Firebase Storage
        //Temporary upload the photo to local
        $name = $file->getClientOriginalName();
        $filepath = storage_path('app/public/uploads/'.$name);
        Storage::put('public/uploads/'. $name, fopen($file, 'r+'));

        //Upload the file to firebase storage
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        $defaultBucket->upload(fopen($filepath, 'r'), [
            'name' => $storagepath.'/'.$name
        ]);

        //Delete the temporary file from local
        Storage::delete('public/uploads/'.$name);

        return 'gs://sharity-f983e.appspot.com/'.$storagepath.'/'.$name;
    }

    public static function getLink($file){

        //Getting the link of the file from Firebase Storage
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        $object = $defaultBucket->object(trim(str_replace('gs://sharity-f983e.appspot.com/','',$file)));
        $link = $object->signedUrl(
            # This URL is valid for 15 minutes
            new \DateTime('15 min'),
            [
                'version' => 'v4',
            ]
        );

        return $link;
    }
}
