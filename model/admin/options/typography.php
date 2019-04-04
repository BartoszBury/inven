<?php
// -> START Typography
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'vine'),
    'id' => 'typography',
    'icon' => 'el el-fontsize',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'vine'),
            'subtitle' => esc_html__('It\'s working if element don\'t use settings "Fonts"', 'vine'),
            'text-align' => false,
            'google' => true,
            'all_styles' => true,
            'default' => array(
                'color' => '#000',
                'font-size' => '14px',
                'line-height' => '24px',
                'font-family' => 'Open Sans',
                'font-weight' => 'Normal',
            ),
        ),
        /*        array(
                    'id'          => 'font_title',
                    'type'        => 'typography',
                    'title'       => esc_html__( 'Title Font', 'vine' ),
                    'line-height' => false,
                    'text-align'  => false,
                    'font-style'  => false,
                    'font-size'   => false,
                    'google'      => true,
                    'default'     => array(
                        'font-family' => 'Montserrat',
                        'subsets'     => '',
                    ),
                ),
                array(
                    'id'      => 'font_size_h1',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H1 (px)', 'vine' ),
                    'default' => '28',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '90',
                ),
                array(
                    'id'      => 'font_weight_h1',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H1', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),
                array(
                    'id'      => 'font_size_h2',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H2 (px)', 'vine' ),
                    'default' => '24',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '80',
                ),
                array(
                    'id'      => 'font_weight_h2',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H2', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),
                array(
                    'id'      => 'font_size_h3',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H3 (px)', 'vine' ),
                    'default' => '22',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '50',
                ),
                array(
                    'id'      => 'font_weight_h3',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H3', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),
                array(
                    'id'      => 'font_size_h4',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H4 (px)', 'vine' ),
                    'default' => '20',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '50',
                ),
                array(
                    'id'      => 'font_weight_h4',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H4', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),
                array(
                    'id'      => 'font_size_h5',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H5 (px)', 'vine' ),
                    'default' => '18',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '50',
                ),
                array(
                    'id'      => 'font_weight_h5',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H5', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),
                array(
                    'id'      => 'font_size_h6',
                    'type'    => 'spinner',
                    'title'   => esc_html__( 'Font Size H6 (px)', 'vine' ),
                    'default' => '16',
                    'min'     => '1',
                    'step'    => '1',
                    'max'     => '50',
                ),
                array(
                    'id'      => 'font_weight_h6',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Font Weight H6', 'vine' ),
                    'options' => array(
                        'normal'  => 'Normal',
                        'bold'    => 'Bold',
                        'lighter' => 'Lighter',
                        '100'     => '100',
                        '200'     => '200',
                        '300'     => '300',
                        '400'     => '400',
                        '500'     => '500',
                        '600'     => '600',
                        '700'     => '700',
                        '800'     => '800',
                        '900'     => '900',
                    ),
                    'default' => 'normal',
                    'select2' => array( 'allowClear' => false )
                ),*/
    )
));