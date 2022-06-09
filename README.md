ico-security-trends
========================
The UK Government body, called the Information Commissioners Office publish this information in non-standardised spreadsheets, however they have recently included their own, more adaptive Microsoft Power BI dashboard. This website breaks down the information collated to provide insight and overview of the data contained inside the spreadsheets.


##  Running the Development Environment

Starting your own development environment is easy, there are three steps,

### Prerequisites

This installation should work on Windows, Mac or Linux. Tested on Windows.

1. Docker or/and Docker Desktop.
2. Docker Compose.

### Installation for Development

1. Use git to clone the latest version to your computer.
2. Alter the supplied example `.env` file as you see fit and place it in the root of the project directory.
3. Use the command `docker-compose up` in the `.docker` folder on your computer, this will build the development environment and install the required database, nginx webserver and php specific dependencies like npm and composer. After about 5 minutes the project should stop outputting to the console and the project should be installed. If you see a 500 or 502 error, the database may not have finished seeding yet, so I would suggest waiting a little longer.

Once the installation is complete, visit `http://localhost/` in your browser to access the project. Open the project in your development environment of choice to make changes.

Note that nginx is not used on the production website which you can visit [here](https://ico-security-trends.infinityflame.co.uk/) so don't spend much time adapting the nginx configuration.


### OGL V3

* You can read the terms of the OGL v3.0 licence [here](https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/)
* Contains public sector information licensed under the Open Government Licence v3.0
