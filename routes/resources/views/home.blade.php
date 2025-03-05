@include('home-styles')
@include('sections.header.html')
@include('home-styles')
<div id="preloader">

    </div>
@php
    $headersection = false;
@endphp
@foreach ($frontSections as $single)
        @if ($single->name != 'Audio Feature' && 
            ($single->slug == 'headersection' || 

                (!$iseditwebsite && $single->section_enabled) || 
                ($iseditwebsite && (
                        ( !$frontSectionSetting->all_feature_for_edit_website && $single->section_enabled  ) 
                        || 
                        ($frontSectionSetting->all_feature_for_edit_website ==1)
                    )
                )
            )
        )
        <?php if($single->slug == 'headersection') { 
            $headersection = $single->section_enabled;
        } ?>
        @if (strpos($single->slug, 'contactForm') !== false || $single->slug == 'headerslider')
            @continue
        @endif
        @if($single->slug == 'headersection')
        @include('sections.'.$single->slug.'.html', ['allFeatures' => $frontSectionSetting->all_feature_for_edit_website])
        @else
        @include('sections.'.$single->slug.'.html')
        @endif
    @endif
@endforeach
@include('sections.footer.html')

@include('sections.popupforms.html')

@include('home-scripts')
