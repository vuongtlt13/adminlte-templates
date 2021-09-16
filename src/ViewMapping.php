<?php


namespace Vuongdq\AdminLTETemplates;


class ViewMapping
{
    public function predictHTMLType($dbName, $dbType) {
        switch ($dbType) {
            case "boolean":
                return "checkbox";
                break;
            case "string":
                $isPassword = strpos($dbName, "password") !== false;
                $isEmail = strpos($dbName, "email") !== false;

                if ($isPassword)
                    return "password";

                if ($isEmail)
                    return "email";

                return "text";
                break;
            case "text":
                return "textarea";
                break;
            case "integer":
            case "bigInteger":
            case "mediumInteger":
            case "id":
            case "smallInteger":
                return "number";
                break;
            case "timestamp":
                return "datetime";
                break;
            case "date":
                return "date";
                break;
            default:
                return "text";
                break;
        }
    }
}
