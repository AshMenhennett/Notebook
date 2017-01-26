# Notebook

This is a repository for a simple Notebook app that I created while learning Laravel and Vue.

Feel free to take a look around the codebase.

##Functionality
- Users can register and create ```Notebook```s, which contain ```Note```s.
- Vue has been used to implement a reactive UI for viewing, creating and deleting ```Notebook```s and ```Note```s.

## Installation & Configuration
If you would like to install this project, treat it as you would any other Laravel application:
- Clone the repo.
- Install dependencies: ```composer install``` (also, ```npm install```, if you need).
- Configure environment variables- ```.env```.
- Generate application key: ```php artisan key:generate```.
- Run Laravel migrations: ```php artisan migrate```.

*Make sure you configure the ```APP_URL``` environment variable, as its used for linking to the application in emails.*

Further steps:
- Set the ```APP_ENV``` environment variable to ```production``` when the app is on a live sever, to force HTTPS connections on all routes.

##Screenshots
###Creatings Notebooks
![Creating Notebooks](https://cloud.githubusercontent.com/assets/9494635/20865419/07f7a98a-ba61-11e6-88c6-66bc2f38074a.PNG)

###Creating Notes
![Creating Notes](https://cloud.githubusercontent.com/assets/9494635/20865417/07f28d74-ba61-11e6-9bd4-feb5df267a49.PNG)

##Routes
![Routes](https://cloud.githubusercontent.com/assets/9494635/21092565/1e5968d4-c09d-11e6-9cbd-5e99d90aa055.PNG)
Thanks to [Pretty Routes](https://github.com/garygreen/pretty-routes)

##License
[MIT](https://s3-ap-southeast-2.amazonaws.com/ashleymenhennett/LICENSE)
