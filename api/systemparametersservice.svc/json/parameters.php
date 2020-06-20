<?php
/* 
{
  "HasErrors": false,
  "Result": {
    "defaultSkinName": "The Asphalt World",
    "envIdentification": "Emr Nightly Build (NBD19A) 2015-12-22",
    "codeCulture": "fr-CA",
    "sessionExpirationDelay": 30,
    "isMultipleProfile": true,
    "defaultCriteriaPageSize": 100,
    "isDateFormat": true,
    "dateFormat": "yyyy/MM/dd",
    "dateFormatSeparator": "-",
    "envIdentificationSL": "Emr Nightly Build (NBD19A) 2015-12-22",
    "codeCultureSL": "en-CA",
    "isUserLayoutActive": true,
    "isReportServiceActive": true,
    "reportServiceUrl": "http://wdevsia4/ReportServer_livrable/ReportService2010.asmx",
    "reportServiceUrlSL": "http://wdevsia4/ReportServer_livrable/ReportService2010.asmx",
    "reportServiceFolder": "/Centre de rapports SIA",
    "reportServiceFolderSL": "/Centre de rapports SIA",
    "isActivateUserOnCreation": true,
    "shortTimePattern": "HH:mm",
    "longTimePattern": "HH:mm"
  },
  "Errors": []
}
*/
    class Parameter {
      public $HasErrors = false;
      public $Result;
      public $Errors = array();
    }
    class Result {
        public $defaultSkinName = "The Asphalt World";
        public $envIdentification = "Emr Nightly Build (NBD19A) 2015-12-22";
        public $codeCulture = "fr-CA";
        public $sessionExpirationDelay = 30;
        public $isMultipleProfile = true;
        public $defaultCriteriaPageSize = 100;
        public $isDateFormat = true;
        public $dateFormat = "yyyy/MM/dd";
        public $dateFormatSeparator = "-";
        public $envIdentificationSL = "Emr Nightly Build (NBD19A) 2015-12-22";
        public $codeCultureSL = "en-CA";
        public $isUserLayoutActive = true;
        public $isReportServiceActive = true;
        public $reportServiceUrl = "http://wdevsia4/ReportServer_livrable/ReportService2010.asmx";
        public $reportServiceUrlSL = "http://wdevsia4/ReportServer_livrable/ReportService2010.asmx";
        public $reportServiceFolder = "/Centre de rapports SIA";
        public $reportServiceFolderSL = "/Centre de rapports SIA";
        public $isActivateUserOnCreation = true;
        public $shortTimePattern = "HH:mm";
        public $longTimePattern = "HH:mm";
    }
	
    $Parameter = new Parameter();
    $Parameter->Result = new Result();

    echo JsonFormatter::prettyPrint(json_encode($Parameter));

    class JsonFormatter {
        public static function prettyPrint(&$j, $indentor = "\t", $indent = "") {
            $inString = $escaped = false;
            $result = $indent;

            if(is_string($j)) {
                $bak = $j;
                $j = str_split(trim($j, '"'));
            }

            while(count($j)) {
                $c = array_shift($j);
                if(false !== strpos("{[,]}", $c)) {
                    if($inString) {
                        $result .= $c;
                    } else if($c == '{' || $c == '[') {
                        $result .= $c."\n";
                        $result .= self::prettyPrint($j, $indentor, $indentor.$indent);
                        $result .= $indent.array_shift($j);
                    } else if($c == '}' || $c == ']') {
                        array_unshift($j, $c);
                        $result .= "\n";
                        return $result;
                    } else {
                        $result .= $c."\n".$indent;
                    } 
                } else {
                    $result .= $c;
                    $c == '"' && !$escaped && $inString = !$inString;
                    $escaped = $c == '\\' ? !$escaped : false;
                }
            }

            $j = $bak;
            return $result;
        }
    }
?>