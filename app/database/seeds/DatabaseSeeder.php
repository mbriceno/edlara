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
            // Create the group
            $group = Sentry::getGroupProvider() -> create(array('name' => 'Users', 'permissions' => array('admin' => 1, 'users' => 1, ), ));
        } catch (Cartalyst\Sentry\Groups\NameRequiredException $e) {
            echo 'Name field is required';
        } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
            echo 'Group already exists';
        }

        try {
            // Create the user
            $user = Sentry::getUserProvider() -> create(array('email' => 'johndoe@example.com', 'password' => 'test234', 'first_name' => 'John', 'last_name' => 'Doe', 'permissions' => array('user.create' => -1, 'user.delete' => -1, 'user.view' => 1, 'user.update' => 1, ), ));

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
            echo 'Group was not found.';
        }

        $this -> call('StudentTableSeeder');
    }

}
