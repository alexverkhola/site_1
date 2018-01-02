<?php

/**
 * Return previous and next month
 *
 * @author valex
 */
class Month {

    private function calculate_month($current) {

        switch ($current) {
            case "january": $previous = "december";
                $next = "february";
                break;
            case "february": $previous = "january";
                $next = "march";
                break;
            case "march": $previous = "february";
                $next = "april";
                break;
            case "april": $previous = "march";
                $next = "may";
                break;
            case "may": $previous = "april";
                $next = "june";
                break;
            case "june": $previous = "may";
                $next = "july";
                break;
            case "july": $previous = "june";
                $next = "august";
                break;
            case "august": $previous = "july";
                $next = "september";
                break;
            case "september": $previous = "august";
                $next = "october";
                break;
            case "october": $previous = "september";
                $next = "november";
                break;
            case "november": $previous = "october";
                $next = "december";
                break;
            case "december": $previous = "november";
                $next = "january";
                break;
        };

        return [$previous, $next];
    }

    public function previous($current) {

        return $this->calculate_month($current)[0];
    }

    public function next($current) {

        return $this->calculate_month($current)[1];
    }

}
