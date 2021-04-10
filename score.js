//Récupérer les éléments du DOM
var elapsedTime = document.querySelector("#elapsed");
var homeTeamImage = document.querySelector("#homeLogo");
var homeTeamName = document.querySelector("#homeName");
var awayTeamImage = document.querySelector("#awayLogo");
var awayTeamName = document.querySelector("#awayName");
var lastMatchGoal = document.querySelector("#goals");
var matchTable = document.querySelector("#matchTable");


//Les fonctions pour créer un élément
function addMatchTile(data) {
    //Création de la tile div
    var matchtile = document.createElement('div');
    matchtile.classList.add("match-tile");

    //Création de la home match box
    var homeTeam = document.createElement('div');
    homeTeam.classList.add("team");
    //Création de l'image et du texte
    var homeTileTeamName = document.createElement('p');
    homeTileTeamName.innerHTML = data['teams']['home']['name'];
    var homeTileTeamLogo = document.createElement('img');
    homeTileTeamLogo.src = data['teams']['home']['logo'];
    homeTeam.appendChild(homeTileTeamLogo);
    homeTeam.appendChild(homeTileTeamName);

    var awayTeam = document.createElement('div');
    awayTeam.classList.add("team");
    //création de l'image et du texte
    var awayTileTeamName = document.createElement('p');
    awayTileTeamName.innerHTML = data['teams']['away']['name'];
    var awayTileTeamLogo = document.createElement('img');
    awayTileTeamLogo.src = data['teams']['away']['logo'];
    awayTeam.appendChild(awayTileTeamLogo);
    awayTeam.appendChild(awayTileTeamName);

    //Création du score
    var score = document.createElement('p');
    score.innerHTML = data['goals']['home'] + " - " + data['goals']['away'];

    //Appliquer tous les éléments au parent
    matchtile.appendChild(homeTeam);
    matchtile.appendChild(score);
    matchtile.appendChild(awayTeam);

    matchTable.appendChild(matchtile);



}
//Récupération des données de l'API
fetch("https://v3.football.api-sports.io/fixtures?live=all", {
    "method": "GET",
    "headers": {
        "x-rapidapi-host": "v3.football.api-sports.io",
        "x-rapidapi-key": "6fb8f9469c604bbbc2f195e76e020e92"
    }
})
    .then(response => response.json().then(data => {
        var matchesList = data['response'];
        var fixture = matchesList[0]['fixture'];
        var goals = matchesList[0]['goals'];
        var teams = matchesList[0]['teams'];
        console.log(matchesList.length);
        //Maintenant, définissons notre premier match
        elapsedTime.innerHTML = fixture['status']['elapsed'] + "'";
        homeTeamImage.src = teams['home']['logo'];
        homeTeamName.innerHTML = teams['home']['name'];
        awayTeamImage.src = teams['away']['logo'];
        awayTeamName.innerHTML = teams['away']['name'];
        lastMatchGoal.innerHTML = goals['home'] + " - " + goals['away'];

        for (var i = 1; i < matchesList.length; i++) {
            addMatchTile(matchesList[i]);
        }

    }))
    .catch(err => {
        console.log(err);
    });

