<?php
namespace WebinaneCommerce\Helpers;

class Formatting {

    /**
     * Convert RGB to HEX.
     *
     * @param mixed $color Color.
     *
     * @return array
     */
    public static function rgb_from_hex( $color ) {
        $color = str_replace( '#', '', $color );
        // Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF".
        $color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );

        $rgb      = array();
        $rgb['R'] = hexdec( $color[0] . $color[1] );
        $rgb['G'] = hexdec( $color[2] . $color[3] );
        $rgb['B'] = hexdec( $color[4] . $color[5] );

        return $rgb;
    }

    /**
     * Determine whether a hex color is light.
     *
     * @param mixed $color Color.
     * @return bool  True if a light color.
     */
    public static function hex_is_light( $color ) {
        $hex = str_replace( '#', '', $color );

        $c_r = hexdec( substr( $hex, 0, 2 ) );
        $c_g = hexdec( substr( $hex, 2, 2 ) );
        $c_b = hexdec( substr( $hex, 4, 2 ) );

        $brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

        return $brightness > 155;
    }
  
    /**
     * Detect if we should use a light or dark color on a background color.
     *
     * @param mixed  $color Color.
     * @param string $dark  Darkest reference.
     *                      Defaults to '#000000'.
     * @param string $light Lightest reference.
     *                      Defaults to '#FFFFFF'.
     * @return string
     */
    public static function light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
        return static::hex_is_light( $color ) ? $dark : $light;
    }

    /**
     * Make HEX color darker.
     *
     * @param mixed $color  Color.
     * @param int   $factor Darker factor.
     *                      Defaults to 30.
     * @return string
     */
    public static function hex_darker( $color, $factor = 30 ) {
        $base  = static::rgb_from_hex( $color );
        $color = '#';

        foreach ( $base as $k => $v ) {
            $amount      = $v / 100;
            $amount      = static::round( $amount * $factor );
            $new_decimal = $v - $amount;

            $new_hex_component = dechex( $new_decimal );
            if ( strlen( $new_hex_component ) < 2 ) {
                $new_hex_component = '0' . $new_hex_component;
            }
            $color .= $new_hex_component;
        }

        return $color;
    }
    
    public static function round( $val, int $precision = 0, int $mode = PHP_ROUND_HALF_UP ) : float {
        if ( ! is_numeric( $val ) ) {
            $val = floatval( $val );
        }
        return round( $val, $precision, $mode );
    }
    
    /**
     * Make HEX color lighter.
     *
     * @param mixed $color  Color.
     * @param int   $factor Lighter factor.
     *                      Defaults to 30.
     * @return string
     */
    public static function hex_lighter( $color, $factor = 30 ) {
        $base  = static::rgb_from_hex( $color );
        $color = '#';

        foreach ( $base as $k => $v ) {
            $amount      = 255 - $v;
            $amount      = $amount / 100;
            $amount      = static::round( $amount * $factor );
            $new_decimal = $v + $amount;

            $new_hex_component = dechex( $new_decimal );
            if ( strlen( $new_hex_component ) < 2 ) {
                $new_hex_component = '0' . $new_hex_component;
            }
            $color .= $new_hex_component;
        }

        return $color;
    }
}