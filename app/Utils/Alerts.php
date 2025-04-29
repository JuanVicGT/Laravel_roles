<?php

namespace App\Utils;

use App\Utils\Enums\AlertIconEnum;
use App\Utils\Enums\AlertTypeEnum;

trait Alerts
{
    /** @var array */
    private $alerts;

    public function __construct()
    {
        $this->alerts = [];
    }

    /**
     * The function "addAlert" adds an alert to an array with a specified type, message, attributes, and
     * translation option.
     *
     * @param string Is a string that represents the content of the alert message.
     * @param ?array attributes An optional array of attributes that can be used to replace placeholders in the
     * message string.
     * @param ?AlertTypeEnum alert_type The alert type parameter is of type AlertTypeEnum, which is an enum that
     * represents different types of alerts (e.g., Info, Success, Warning, Error).
     * @param ?bool trans Is a boolean flag that indicates whether the message should be
     * translated or not.
     */
    public function addAlert(string $message, ?array $attributes = [], ?AlertTypeEnum $alert_type = null, ?bool $trans = true): void
    {
        $this->alerts[] = (object) [
            'type' => $alert_type ?? AlertTypeEnum::Info,
            'message' => $trans ? __($message, $attributes) : $message,
            'title' => ''
        ];
    }

    /**
     * The function "getAlerts" returns an array of alerts.
     * 
     * @return array
     */
    public function getAlerts(): array
    {
        return session('alerts', $this->alerts ?? []);
    }

    /**
     * The function "getAlertsArray" returns an array of alerts.
     * 
     * @return array
     */
    public function getAlertsArray(): array
    {
        if (empty($this->alerts)) {
            return [];
        }

        return $this->alerts;
    }

    /**
     * The function "getAlertsView" forces the system to shows alerts in a view.
     * 
     * If exist any alerts before, they will be overwritten
     * 
     * @return void
     */
    public function showAlertsView(): void
    {
        if (empty($this->alerts)) {
            return;
        }

        session()->now('alerts', $this->alerts);
    }

    public function clearAlerts(): void
    {
        $this->alerts = [];
        session()->forget('alerts');
    }
}
