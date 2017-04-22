<?php

use App\User;
use Mockery as M;
use App\Models\Job;
use App\Exceptions\Handler;
use App\Mailer\InMemoryInBox;
use Illuminate\Contracts\Debug\ExceptionHandler;

/**
 * Class TestCase
 */
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
    protected $user;
    protected $mailer;

    /** @before */
    function setUpInMemoryBox()
    {
        $this->mailer = new InMemoryInBox;
        $this->app->instance('mailer', $this->mailer);
    }


    protected function assertMessageSentFor($email)
    {
        $this->assertTrue($this->mailer->hasMessageFor($email));
    }


    protected function assertMessageSentWithSubject($subject)
    {
        $this->assertTrue($this->mailer->hasMessageWithSubject($subject));
    }


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @param null $user
     * @return $this
     */
    protected function signInUser($user = null)
    {
        if (!$user) {
            $user = factory(User::class)->create();
        }

        $this->actingAs($user);

        $this->user = $user;

        return $this;
    }


    protected function assertPushed($class)
    {
        $className = $this->resolveClassname($class);

        $this->assertTrue($this->isJobPushed($className), "The designated class $className has not been pushed to queue.");
    }


    protected function assertNotPushed($class)
    {
        $className = $this->resolveClassname($class);

        $this->assertFalse($this->isJobPushed($className), "The designated class $className is pushed to queue.");
    }


    private function resolveClassname($class)
    {
        return get_class(App::make($class));
    }


    private function isJobPushed($className)
    {
        //retrieve current job collection in DB
        $jobs = collect(Job::all()->toArray());

        //resolve job collection
        $newJobs = $jobs->map(function ($job) {
            return \GuzzleHttp\json_decode($job['payload']);
        });

        return
            $newJobs->contains(function ($job) use ($className) {
                //make sure the command string contains className
                return strpos($job->data->command, $className);
            });
    }


    /**
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }


    public function spy($class)
    {
        $mock = Mockery::spy($class);

        $this->app->instance($class, $mock);

        return $mock;
    }


    public function tearDown()
    {
        M::close();
    }


    protected function makeObjJson($obj)
    {
        return \GuzzleHttp\json_encode($obj);
    }

    // Use this version if you're on PHP 5
    protected function disableExceptionHandling()
    {
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }


//    protected function disableExceptionHandling()
//    {
//        app()->instance(Handler::class, new class extends Handler {
//            public function __construct() {}
//            public function report(Exception $e)
//            {
//                // no-op
//            }
//            public function render($request, Exception $e)
//            {
//                throw $e;
//            }
//        });
//    }

}

class PassThroughHandler extends Handler
{
    public function __construct()
    {
    }

    public function report(Exception $e)
    {
        // no-op
    }

    public function render($request, Exception $e)
    {
        throw $e;
    }
}
