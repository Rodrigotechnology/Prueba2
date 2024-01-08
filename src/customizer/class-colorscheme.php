<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerColor;

class CustomizerColorScheme
{
    private $Colors = array();

    public function __construct()
    {
        //
        $this->AddColor(new CustomizerColor(
            '--superb-pixels-primary',
            __('Primary', 'superb-pixels'),
            __('Sets the primary colors for the theme.', 'superb-pixels'),
            '#f5a834',
            '#d78a16'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--superb-pixels-secondary',
            __('Secondary', 'superb-pixels'),
            __('Sets the secondary colors for the theme.', 'superb-pixels'),
            '#fcf1ea',
            '#ded3cc'
        ));
        //
    }

    /* ****************************** */

    public function GetColors()
    {
        return $this->Colors;
    }

    private function AddColor($color)
    {
        $this->Colors[$color->GetId()] = $color;
        if (false !== $color->GetDarkId()) {
            $this->Colors[$color->GetDarkId()] = new CustomizerColor(
                $color->GetDarkId(),
                'Dark Variant',
                'Sets the dark variant for the color.',
                $color->GetDarkDefault()
            );
        }
    }

    public function MaybeGetDefault($control_id)
    {
        if (isset($this->Colors[$control_id])) {
            return $this->Colors[$control_id]->GetDefault();
        }
        return false;
    }

    public function GetColorIdsNoVariants()
    {
        return array_map(function ($item) {
            return $item->GetId();
        }, array_values(array_filter($this->Colors, function ($item) {
            return false === $item->GetDarkId();
        })));
    }

    public function GetColorIdsVariantsOnly()
    {
        return array_map(function ($item) {
            if (false !== $item->GetDarkId())
                return array('REGULAR' => $item->GetId(), 'DARK' => $item->GetDarkId());
        }, array_values(array_filter($this->Colors, function ($item) {
            return false !== $item->GetDarkId();
        })));
    }
}
