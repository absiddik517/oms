<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $file_path
 * @property string|null $file_name
 * @property string|null $file_type
 * @property int|null $file_size
 * @property string $disk
 * @property int|null $uploaded_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Letter|null $letter
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereUploadedBy($value)
 */
	class Attachment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $office_id
 * @property string $name
 * @property string|null $description
 * @property string $code
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Office $office
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder currentoffice()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereUpdatedAt($value)
 */
	class Folder extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $office_id
 * @property int|null $topic_id
 * @property int|null $folder_id
 * @property string|null $letter_number
 * @property string|null $subject
 * @property string|null $body
 * @property string|null $letter_date
 * @property int|null $officer_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\Folder|null $folder
 * @property-read \App\Models\Office|null $office
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recipient> $recipients
 * @property-read int|null $recipients_count
 * @property-read \App\Models\Topic|null $topic
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter currentoffice()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereLetterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereLetterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereOfficerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Letter whereUpdatedBy($value)
 */
	class Letter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $office_name
 * @property string $upazila
 * @property string $district
 * @property string|null $geo_code
 * @property string|null $office_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereGeoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereOfficeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereOfficeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereUpazila($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereUpdatedAt($value)
 */
	class Office extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $designation
 * @property string $category
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone
 * @property string $status
 * @property string|null $joining_date
 * @property string|null $leaving_date
 * @property int $office_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Office $office
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer currentoffice()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereJoiningDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereLeavingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Officer whereUpdatedBy($value)
 */
	class Officer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $designation
 * @property string|null $organization
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereUpdatedBy($value)
 */
	class Recipient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $office_id
 * @property string $name
 * @property string $code
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic currentoffice()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Topic whereUpdatedBy($value)
 */
	class Topic extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $office_id
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Office|null $office
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

