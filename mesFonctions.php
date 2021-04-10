  
<?php


class FootballData
{

    public $config;
    public $baseUri;
    public $reqPrefs = array();

    public function __construct()
    {
        $this->config = parse_ini_file('config.ini', true);


        if ($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
            exit();
        }

        $this->baseUri = $this->config['baseUri'];

        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }

    /**
     * La fonction retourne une compétition particulière identifiée par un identifiant.
     */
    public function findCompetitionById($id)
    {
        $resource = 'competitions/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    /**
     * La fonction renvoie toutes les correspondances disponibles pour une plage de dates donnée.
     */
    public function findMatchesForDateRange($start, $end)
    {
        $resource = 'matches/?dateFrom=' . $start . '&dateTo=' . $end;

        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    public function findMatchesByCompetitionAndMatchday($c, $m)
    {
        $resource = 'competitions/' . $c . '/matches/?matchday=' . $m;

        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    public function findStandingsByCompetition($id)
    {
        $resource = 'competitions/' . $id . '/standings';
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }


    public function findHomeMatchesByTeam($teamId)
    {
        $resource = 'teams/' . $teamId . '/matches/?venue=HOME';
        //http://api.football-data.org/v2/teams/62/matches?venue=home

        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response)->matches;
    }

    /**
     * La fonction renvoie un match unique identifié par un identifiant donné.
     */
    public function findMatchById($id)
    {
        $resource = 'matches/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    /**
     * La fonction renvoie une équipe unique identifiée par un identifiant donné.
     */
    public function findTeamById($id)
    {
        $resource = 'teams/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    /**
     * La fonction renvoie toutes les équipes correspondant à un mot-clé donné.
     */
    public function searchTeam($keyword)
    {
        $resource = 'teams/?name=' . $keyword;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }
}
