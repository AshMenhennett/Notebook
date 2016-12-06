# Notebook

This is a repository for a simple Notebook app that I created while learning Laravel and Vue.

Feel free to take a look around the codebase.

##Functionality
- Users can register and create ```Notebook```s, which contain ```Note```s.
- Each ```Notebook``` can have many ```Note```s.
- Each ```Note``` belongs to only one ```Notebook```.
- Vue has been used to implement a reactive UI for viewing, creating and deleting ```Notebook```s and ```Note```s.

##Screenshots
###Creatings Notebooks
![Creating Notebooks](https://cloud.githubusercontent.com/assets/9494635/20865419/07f7a98a-ba61-11e6-88c6-66bc2f38074a.PNG)

###Creating Notes
![Creating Notes](https://cloud.githubusercontent.com/assets/9494635/20865417/07f28d74-ba61-11e6-9bd4-feb5df267a49.PNG)

## Installation & Configuration
If you would like to install this project, treat it as you would any other Laravel application.
*Make sure you set the ```APP_ENV``` environment variable to ```production``` when the app is on a live sever, to force HTTPS connections on all routes.*
