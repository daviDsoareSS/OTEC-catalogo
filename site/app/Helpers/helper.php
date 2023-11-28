<?php

    /*
    public $sslForce = false;

    function sslForce($url)
    {
        if($this->sslForce)
            return str_replace('http','https', $url);

        return $url;

    }
    */

    function getPage() {
        $url = $_SERVER['REQUEST_URI'];
        $explode = explode('/',$url);
        $page = end($explode);

        return $page;

    }

    // FUNÇÃO PARA RETORNAR DADOS CONSTANTES NO SITE
    function getItem($data)
    {
        $array = array(

            'APP_URL_ARTICLES' => 'http://127.0.0.1:8081/adm/acompanhe/',

            //client
            'client' => 'OTEC Shop',
            'email-client' => 'adm@engenhodeimagens.com.br',
            'email-link' => '',
            'subjectMail' => 'Subject',
            'link-site' => 'https://www.otecshop.com.br/',

            // whats number
            'link-whats1' => "https://api.whatsapp.com/send?phone=5511",
            'whats1' =>  "(11) 91122-3344",
            'link-whats2' => "https://api.whatsapp.com/send?phone=5511",
            'whats2' => '',

            // telefones numner
            'link-number1' => 'tel:+551112334455',
            'number1' => '(11) 1233-4455',
            'link-number2' => '',
            'number2' => '',

            // social medias
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
            'youtube' => '',
            'email' => 'contato@cliente.com',
            'acomp-image-resolution' => '200 x 200' ,
            'equipe-image-resolution' => '200 x 200' ,
            'link-local' => 'https://maps.app.goo.gl/jRSUiw668t1yPR1A8',
            'name-local' => 'R. Três, 1255 - Centro, Rio Claro/SP',

        );

        if (isset($array[$data]))
            return $array[$data];

        return "nada encontrado";
    }

    // FUNÇÃO PARA MOSTRAR O MES EM STRING
    function showMonth($mes)
    {
        switch($mes) {
            case 1:
                $dateValue = "Janeiro";
                break;

            case 2:
                $dateValue = "Fevereiro";
                break;

            case 3:
                $dateValue = "Março";
                break;

            case 4:
                $dateValue = "Abril";
                break;

            case 5:
                $dateValue = "Maio";
                break;

            case 6:
                $dateValue = "Junho";
                break;

            case 7:
                $dateValue = "Julho";
                break;

            case 8:
                $dateValue = "Agosto";
                break;

            case 9:
                $dateValue = "Setembro";
                break;

            case 10:
                $dateValue = "Outubro";
                break;

            case 11:
                $dateValue = "Novembro";
                break;

            case 12:
                $dateValue = "Dezembro";
                break;
        }
        if($mes != null)
            return $dateValue;

        return "A váriavel está vazia";

    }

    // FUNÇÃO PARA MOSTRAR O DIA EM STRING
    function showDay($day)
    {
        $date = $day;
        $dateFinal = substr($date, 0, 2);
        return $dateFinal;
    }

    function showYear($day)
    {
        $date = $day;
        $dateFinal = substr($date, 6, 4);
        return $dateFinal;
    }

    // FUNÇÃO PARA FORMATAR URL PARA URL AMIGÁVEL
    function cleanUrl($title)
    {
        // Convert the title to lowercase and replace accented characters
        $url = mb_strtolower($title, 'UTF-8');
        $url = str_replace(
            ['á', 'à', 'ã', 'â', 'ä', 'é', 'è', 'ê', 'ë', 'í', 'ì', 'î', 'ï', 'ó', 'ò', 'õ', 'ô', 'ö', 'ú', 'ù', 'û', 'ü', 'ñ', 'ç'],
            ['a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'n', 'c'],
            $url
        );

        // Remove special characters and punctuation
        $url = preg_replace('/[^a-z0-9\s-]/', '', $url);

        // Replace spaces with hyphens
        $url = str_replace(' ', '-', $url);

        // Remove duplicate hyphens
        $url = preg_replace('/-+/', '-', $url);


        // Trim any leading or trailing hyphens
        $url = trim($url, '-');

        return $url;
    }


// FUNÇÃO PARA TIRAR OS SEGUNDOS DA HORA
    function noSeg($time)
    {
        $time = explode(":", $time);
        list($hora, $min, $seg) = $time;

        return $hora.':'.$min;
    }

    // FUNÇÕES PARA EXIBIR TIPOS DIFERENTES DE DATAS
    function formatDate($data, $tipo)
    {

        $data = explode("/", $data);
        list($dia, $mes, $ano) = $data;


        if($tipo == 1) {
            return $ano.'-'.$mes.'-'.$dia;

        }else if($tipo == 2){

            return $dia.'-'.$mes.'-'.$ano;

        }else if($tipo == 3){

            $mes = showMonth($mes);

            return $dia.' '.substr($mes, 0, 3).' '.$ano;
        }
        else if($tipo == 4){

            $mes = showMonth($mes);

            return $dia.' '.$mes.' '.$ano;

        }
        else if($tipo == 5){

            $mes = showMonth($mes);

            return $dia.' de '.$mes.' de '.$ano;

        }

    }

    // FUNÇÃO PARA LIMITAR QUANTIDADE DE CARACTERES NA PÁGINA //
    function limitString($string,$limit)
    {

        return (strlen($string) > $limit) ? mb_substr($string, 0, $limit).'...' : $string;

    }

    // FUNÇÃO PARA CONVERTER DATA E HORA PARA TIMESTAMP
    function toTimestamp($date, $time)
    {
        $dataForm = formatDate($date, 1);

        return strtotime($dataForm." ".$time);

    }

    // FUNÇÃO PARA EXIBIR O TEMPO CORRIDO
    function runningTime($dateTime)
    {
        // data e hora atual
        $now = strtotime(date('Y/m/d H:i:s'));
        $time = strtotime($dateTime);
        $diff = $now - $time;

        // quebrando
        $seconds = $diff;
        $minutes = round($diff / 60);
        $hours = round($diff / 3600);
        $days = round($diff / 86400);
        $weeks = round($diff / 604800);
        $months = round($diff / 2419200);
        $years = round($diff / 29030400);

        // exibindo a diferencia de tempo
        if ($seconds <= 60) return "1 min atrás";
        else if ($minutes <= 60) return $minutes==1 ?'1 min atrás':$minutes.' min atrás';
        else if ($hours <= 24) return $hours==1 ?'1 hrs atrás':$hours.' hrs atrás';
        else if ($days <= 7) return $days==1 ?'1 dia atras':$days.' dias atrás';
        else if ($weeks <= 4) return $weeks==1 ?'1 semana atrás':$weeks.' semanas atrás';
        else if ($months <= 12) return $months == 1 ?'1 mês atrás':$months.' meses atrás';
        else return $years == 1 ? 'um ano atrás':$years.' anos atrás';
    }
