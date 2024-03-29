<?php namespace App\Http\Controllers\xAPI;

use \Locker\Data\Analytics\AnalyticsInterface as AnalyticsData;
use \Request;

class Analytics extends Base {
  protected $analytics;

  /**
   * Constructs a new AnalyticsController.
   * @param AnalyticsData $analytics
   */
  public function __construct(AnalyticsData $analytics) {
    parent::__construct();
    $this->analytics = $analytics;
  }

  // http://docs.learninglocker.net/analytics_api/
  public function index() {
    $data = $this->analytics->timedGrouping($this->getOptions()['lrs_id'], Request::all());
    return $this->returnJson($data);
  }
}
