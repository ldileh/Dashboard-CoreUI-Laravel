# admin-coreui-laravel

## Features
- bootstrap v4
- font awesome
- flag-icon
- jquery
- [datatables laravel ~8.0] (https://github.com/yajra/laravel-datatables)
- [vex] (https://github.hubspot.com/vex/)
- [select2] (https://select2.org/)
- [bootstrap datepicker] (https://bootstrap-datepicker.readthedocs.io)
- pace
- popper
- [chartjs] (http://www.chartjs.org/)

## Step to install
1. clone this repo
2. open terminal or command line and move to this dir application
3. run command : composer install
4. run command : npm install
5. run command : npm run prod / npm run dev
5. copy file .env.example and rename to .env
5. configure application in file .env
6. run command : php artisan config:cache 
7. run command : php artisan cache:clear
8. run command : php artisan migrate --seed
9. finish