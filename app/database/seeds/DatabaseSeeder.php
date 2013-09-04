<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
       
        try {
            // Create the user
            $user = Sentry::getUserProvider() -> create(array(
                 'email' => 'johndoe@example.com',
                 'password' => 'user123456',
                 'activation_code'=>'8f1Z7wA4uVt7VemBpGSfaoI9mcjdEwtK8elCnQOb',
                 'first_name' => 'John',
                 'last_name' => 'Doe',
                 'permissions' => array(
                             'user.create' => 1,
                             'user.delete' => 1,
                             'user.view' => 1,
                             'user.update' => 1, ), ));

            // Find the group using the group id
            $adminGroup = Sentry::getGroupProvider() -> findById(1);

            // Assign the group to the user
            $user -> addGroup($adminGroup);
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            echo 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            echo 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            echo 'User with this login already exists.';
        } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
            echo 'Group was not found.';        }
        try
    {
    // Find the user using the user id
    $user = Sentry::getUserProvider()->findById(1);

    // Update the user details
    $user->activation_code = '8f1Z7wA4uVt7VemBpGSfaoI9mcjdEwtK8elCnQOb';

    // Update the user
    if ($user->save())
    {
        // User information was updated
    }
    else
    {
        // User information was not updated
    }
 try
        {
            // Create the group
            $group = Sentry::getGroupProvider()->create(array(
            'name'        => 'admin',
                'permissions' => array(
                    'admin' => 1
                    ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

            $admin = Sentry::getGroupProvider()->findById(1);

            $user = Sentry::getUserProvider()->findById(1);
            $user->addGroup($admin);
            unset($admin);
            unset($user);

        try
        {
            // Create the group
            $group = Sentry::getGroupProvider()->create(array(
            'name'        => 'teachers',
                'permissions' => array(
                    'create_tutorial'=> 1,
                    'update_tutorial'=> 1,
                    'create_exam' =>1,
                    'update_exam' =>1,
                    'see_results' => 1,
                    'see_result' => 1
                    ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

        try
        {
            // Create the group
            $group = Sentry::getGroupProvider()->create(array(
            'name'        => 'students',
                'permissions' => array(
                    'see_tutorial'=> 1,                    
                    'do_exam' =>1,
                    'see_result' => 1
                    ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

}
catch (Cartalyst\Sentry\Users\UserExistsException $e)
{
    echo 'User with this login already exists.';
}
catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
{
    echo 'User was not found.';
}
try
{
    // Find the user using the user id
    $user = Sentry::getUserProvider()->findById(1);

    // Attempt to activate the user
    if ($user->attemptActivation('8f1Z7wA4uVt7VemBpGSfaoI9mcjdEwtK8elCnQOb'))
    {
        // User activation passed
    }
    else
    {
        // User activation failed
    }
}
catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
{
    echo 'User was not found.';
}
catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
{
    echo 'User is already activated.';
}

        $this -> call('StudentTableSeeder');        
        $this->call('SubjectTableSeeder');
    }

}
