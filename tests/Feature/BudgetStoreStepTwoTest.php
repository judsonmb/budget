<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerStoredEmail;

class BudgetStoreStepTwoTest extends TestCase
{
    public function testBudgetStoreStepTwoWebProjectSuccess(): void
    {
        Mail::fake();

        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Saved successfully!']);

        $this->assertDatabaseHas('customers', [
            'name' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'address' => $customer['address'],
        ]);

        $latestCustomerId = \App\Models\Customer::latest()->get()[0]->id;
        $latestProjectId = \App\Models\WebProject::latest()->get()[0]->id;

        $this->assertDatabaseHas('web_projects', [
            'pages_number' => $project['pages_number'],
            'has_login' => $project['has_login'],
            'has_payment' => $project['has_payment'],
            'customer_id' => $latestCustomerId,
        ]);

        $this->assertDatabaseHas('browser_web_project', [
            'web_project_id' => $latestProjectId,
            'browser_id' => 1,
        ]);

        $this->assertDatabaseHas('browser_web_project', [
            'web_project_id' => $latestProjectId,
            'browser_id' => 2,
        ]);

        Mail::assertSent(CustomerStoredEmail::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer['email']) &&
                   $mail->hasFrom(env('MAIL_FROM_ADDRESS'));
        });
    }

    public function testBudgetStoreStepTwoMobileProjectSuccess(): void
    {
        Mail::fake();

        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make()->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Saved successfully!']);

        $this->assertDatabaseHas('customers', [
            'name' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'address' => $customer['address'],
        ]);

        $latestCustomerId = \App\Models\Customer::latest()->get()[0]->id;

        $this->assertDatabaseHas('mobile_projects', [
            'platform' => $project['platform'],
            'screens_number' => $project['screens_number'],
            'has_login' => $project['has_login'],
            'has_payment' => $project['has_payment'],
            'customer_id' => $latestCustomerId,
        ]);

        Mail::assertSent(CustomerStoredEmail::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer['email']) &&
                   $mail->hasFrom(env('MAIL_FROM_ADDRESS'));
        });
    }

    public function testBudgetStoreStepTwoDesktopProjectSuccess(): void
    {
        Mail::fake();

        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make()->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Saved successfully!']);

        $this->assertDatabaseHas('customers', [
            'name' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'address' => $customer['address'],
        ]);

        $latestCustomerId = \App\Models\Customer::latest()->get()[0]->id;

        $this->assertDatabaseHas('desktop_projects', [
            'supported_os' => $project['supported_os'],
            'screens_number' => $project['screens_number'],
            'supports_prints' => $project['supports_prints'],
            'access_license' => $project['access_license'],
            'customer_id' => $latestCustomerId,
        ]);

        Mail::assertSent(CustomerStoredEmail::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer['email']) &&
                   $mail->hasFrom(env('MAIL_FROM_ADDRESS'));
        });
    }

    //other validation tests, like field type, the field size

    public function testBudgetStoreStepTwoWithoutCustomerName(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make();
        unset($customer->name);

        $customer = $customer->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The name field is required.',
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutCustomerEmail(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make();
        unset($customer->email);

        $customer = $customer->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The email field is required.',
            'errors' => [
                'email' => [
                    'The email field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutCustomerPhone(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make();
        unset($customer->phone);

        $customer = $customer->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The phone field is required.',
            'errors' => [
                'phone' => [
                    'The phone field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutCustomerAddress(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make();
        unset($customer->address);

        $customer = $customer->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The address field is required.',
            'errors' => [
                'address' => [
                    'The address field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutProjectType(): void 
    {
        $body = [];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The type field is required.',
            'errors' => [
                'type' => [
                    'The type field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutWebProjectPagesNumber(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]]);
        unset($project->pages_number);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The pages number field is required when type is web.',
            'errors' => [
                'pages_number' => [
                    'The pages number field is required when type is web.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutWebProjectHasLogin(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]]);
        unset($project->has_login);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The has login field is required when type is web.',
            'errors' => [
                'has_login' => [
                    'The has login field is required when type is web.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutWebProjectHasPayment(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]]);
        unset($project->has_payment);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The has payment field is required when type is web.',
            'errors' => [
                'has_payment' => [
                    'The has payment field is required when type is web.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithWebProjectBrowserThatDoesntExist(): void 
    {
        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,6]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The selected browsers is invalid.',
            'errors' => [
                'browsers' => [
                    'The selected browsers is invalid.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutMobileProjectPlatform(): void 
    {
        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make();
        unset($project->platform);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The platform field is required when type is mobile.',
            'errors' => [
                'platform' => [
                    'The platform field is required when type is mobile.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithMobileProjectPlatformThatDoesntExist(): void 
    {
        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make(['platform' => 'test'])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The selected platform is invalid.',
            'errors' => [
                'platform' => [
                    'The selected platform is invalid.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutMobileProjectScreensNumber(): void 
    {
        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make();
        unset($project->screens_number);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The screens number field is required when type is mobile.',
            'errors' => [
                'screens_number' => [
                    'The screens number field is required when type is mobile.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutMobileProjectHasLogin(): void 
    {
        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make();
        unset($project->has_login);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The has login field is required when type is mobile.',
            'errors' => [
                'has_login' => [
                    'The has login field is required when type is mobile.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutMobileProjectHasPayment(): void 
    {
        $body = ['type' => 'mobile'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\MobileProject::factory()->make();
        unset($project->has_payment);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The has payment field is required when type is mobile.',
            'errors' => [
                'has_payment' => [
                    'The has payment field is required when type is mobile.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutDesktopProjectSupportedOs(): void 
    {
        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make();
        unset($project->supported_os);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The supported os field is required when type is desktop.',
            'errors' => [
                'supported_os' => [
                    'The supported os field is required when type is desktop.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithDesktopProjectSupportedOsThatDoesntExist(): void 
    {
        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make(['supported_os' => 'test'])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The selected supported os is invalid.',
            'errors' => [
                'supported_os' => [
                    'The selected supported os is invalid.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutDesktopProjectScreensNumber(): void 
    {
        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make();
        unset($project->screens_number);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The screens number field is required when type is desktop.',
            'errors' => [
                'screens_number' => [
                    'The screens number field is required when type is desktop.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutDesktopProjectSupportsPrints(): void 
    {
        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make();
        unset($project->supports_prints);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The supports prints field is required when type is desktop.',
            'errors' => [
                'supports_prints' => [
                    'The supports prints field is required when type is desktop.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepTwoWithoutDesktopProjectAccessLicense(): void 
    {
        $body = ['type' => 'desktop'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\DesktopProject::factory()->make();
        unset($project->access_license);

        $project = $project->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The access license field is required when type is desktop.',
            'errors' => [
                'access_license' => [
                    'The access license field is required when type is desktop.'
                ]
            ]
        ]);
    }
}
