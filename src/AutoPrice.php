<?php
namespace thealgoslingers;
/**
 * The AutoPrice class provides functionalities for calculating prices dynamically based on the user's location.
 */
class AutoPrice {
    private $api_key;
    private $base_price;

    /**
     * Constructor for the AutoPrice class.
     *
     * @param string $api_key The API key used for retrieving geo data.
     * @param float $base_price The base price used as a starting point for price calculations.
     */
    public function __construct($api_key, $base_price) {
        $this->api_key = $api_key;
        $this->base_price = $base_price;
    }

    /**
     * Retrieves geo data based on the provided IP address.
     *
     * @param string $ip_address The IP address for which to retrieve geo data.
     *
     * @return array An associative array containing the retrieved geo data.
     */
    private function getGeoData($ip_address) {
        $url = "https://api.ip2location.io/?key={$this->api_key}&ip={$ip_address}";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    /**
     * Calculates the price based on the user's IP address.
     *
     * @param string $ip_address The IP address of the user.
     *
     * @return float The calculated price based on the user's location.
     */
    public function calculatePrice($ip_address) {
        $geo_data = $this->getGeoData($ip_address);
        $country = $geo_data['country_name'];
        $code = $geo_data['country']['currency']['code'] == '' ? '' : $geo_data['country']['currency']['code'];
        
        $adjustment_factor = $this->getAdjustmentFactorForCountry($country);
        return $code . round($this->base_price * $adjustment_factor, 2);
    }

    /**
     * Retrieves the adjustment factor for a given country.
     *
     * @param string $country The name of the country.
     *
     * @return float The adjustment factor for the given country.
     */
    private function getAdjustmentFactorForCountry($country) {
        // Placeholder for actual adjustment factor logic based on country.
        // You can use a currency converter based on the country to adjust the price.
        // For testing purposes, let's use this predefined set of adjustment factors.
        $adjustment_factors = [
            'United States' => 1.0,
            'India'         => 0.8,
            'Japan'         => 1.2,
            'Ghana'         => 15.3,
            'Germany'       => 1.3
        ];
        return $adjustment_factors[$country] ?? 1.0;
    }
}
?>
