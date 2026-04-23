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
 * @property int $office_id
 * @property string $name
 * @property string|null $description
 * @property string $code
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Office $office
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
 * @property string $name
 * @property int $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LetterTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LetterType whereUpdatedAt($value)
 */
	class LetterType extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereUpdatedBy($value)
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

