<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:STUTuna/line-bot-exam-management.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('43.224.35.84')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/line-bot-exam-management');

// Hooks

after('deploy:failed', 'deploy:unlock');
