<?php

namespace App\Providers;

use App\Events\User\ConfirmationEmailRequested;
use App\Events\User\SignedIn;
use App\Listeners\NewDiscussionListener;
use App\Listeners\User\StampSignedIn;
use App\Listeners\User\WelcomeEmail;
use App\Events\User\UserEmailChanged;
use Illuminate\Auth\Events\Registered;
use App\Listeners\User\ConfirmationEmail;
use Acme\Tool\Discussionable\Events\DialogueJoined;
use Acme\Tool\Discussionable\Events\DiscussionRaised;
use Acme\Tool\Discussionable\Listeners\NewDialogueNotice;
use Acme\Tool\Discussionable\Listeners\NewDiscussionNotice;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        SignedIn::class => [
            StampSignedIn::class
        ],
        Registered::class => [
            WelcomeEmail::class,
        ],
        UserEmailChanged::class => [
            ConfirmationEmail::class
        ],
        ConfirmationEmailRequested::class => [
            ConfirmationEmail::class
        ],
        DiscussionRaised::class => [
            NewDiscussionListener::class
        ],
//        DialogueJoined::class => [
//            NewDialogueNotice::class
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
