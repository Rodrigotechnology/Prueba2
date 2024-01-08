<?php
defined("ABSPATH") || exit();

class SuperbInfoContentConfig
{
    const THEME_LINK = 'https://superbthemes.com/superb-pixels/';
    const DEMO_LINK = 'https://superbthemes.com/demo/superb-pixels/';

    private $FEATURES = array();

    public function __construct()
    {
        $this->AddFeature(__("Customize Header Logo, Text & Background Color", "superb-pixels"), "purple-paint-brush.svg");
        $this->AddFeature(__("Translation Ready", "superb-pixels"), "purple-article-medium.svg");
        $this->AddFeature(__("Fully SEO Optimized", "superb-pixels"), "purple-gauge.svg");
        $this->AddFeature(__("Customize All Fonts", "superb-pixels"), "purple-article-medium.svg");
        $this->AddFeature(__("Customize All Colors", "superb-pixels"), "purple-paint-brush.svg");
        $this->AddFeature(__("Importable Demo Content", "superb-pixels"), "purple-images.svg");
        $this->AddFeature(__("Elementor Compatible", "superb-pixels"), "purple-elementor-logo.svg");
        $this->AddFeature(__("Replace Copyright Text", "superb-pixels"), "purple-copyright.svg");
        $this->AddFeature(__("Full-Width Page Template", "superb-pixels"), "purple-frame-corners.svg");
        $this->AddFeature(__("Access All Child Themes", "superb-pixels"), "purple-images.svg");
        $this->AddFeature(__("Customer Support and Documentation", "superb-pixels"), "purple-files.svg");
        $this->AddFeature(__("Multiple Website Support", "superb-pixels"), "purple-files.svg");


        $this->AddFeature(__("Show Full Posts on Blog", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Only Display Header Widgets on Front Page", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Show 'Continue Reading' Button on Blog", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show 'Go To Top' Button", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/show Shopping Cart in Navigation", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("'Related Posts' Section on Posts", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("'Hide Author Name in Byline", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Add Custom Button to Header", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Only Show Header On Front Page", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("About The Author Section", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Next/Previous Post Buttons", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Categories and Tags", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Author Name From Byline", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Post Category on Blog", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Related Posts", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Sidebar on WooCommerce Pages", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Sidebar on Blog Feed, Search Page and Archive Pages", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Sidebar on Posts & Pages", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Header Button on Mobile", "superb-pixels"), "gear.svg");
        $this->AddFeature(__("Hide/Show Header Tagline on Mobile", "superb-pixels"), "gear.svg");


        $this->AddFeature(__("Remove 'Tag' from Tag Page Title", "superb-pixels"), "purple-article-medium.svg");
        $this->AddFeature(__("Remove 'Author' from Author Page Title", "superb-pixels"), "purple-article-medium.svg");
        $this->AddFeature(__("Remove 'Category' from Category Page Title", "superb-pixels"), "purple-article-medium.svg");
    }

    private function AddFeature($title, $icon)
    {
        $this->FEATURES[] = array(
            "title" => $title,
            "icon" => $icon
        );
    }

    public function GetFeatures()
    {
        return $this->FEATURES;
    }
}
