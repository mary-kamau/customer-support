## Customer Support Chat Application
This is a real-time customer support chat application built with Laravel and Livewire. It allows users to input their queries and see responses in real-time.

Features
Real-time message updates using Livewire
Message broadcasting with Pusher (optional)
Simple and intuitive user interface
Prerequisites
PHP >= 7.3
Composer
Pusher account (To get Pusher details siign up for a pusher account at https://dashboard.pusher.com/) 
Installation

# Clone this repository:
  - git clone https://github.com/mary-kamau/customer-support.git
  - cd customer-support
# Install dependencies:
  - composer install
  - composer update

# Set up the environment:
Copy the .env.example file to .env and update the necessary configurations, especially the database settings and pusher settings.
Create  .env file
  - cp .env.example .env

# Generate application key:
  - php artisan key:generate

# Broadcasting Configuration:

Set the default broadcaster to Pusher in config/broadcasting.php:
  - 'default' => env('BROADCAST_DRIVER', 'pusher'),

Run the migration for the jobs table:
  - php artisan queue:table

Run database migrations:
  - php artisan migrate
# CheckOut development branch for latest updates
  - git checkout development



