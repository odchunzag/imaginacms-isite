@php $d=rand(1,200); @endphp
@switch($imagePosition)
  @case('1')
  @php $row=""; $col1=""; $col2="image-overlay item-border";  @endphp
  @break
  @case('2')
  @php $row="item-border"; $col1=$columnLeft." px-0"; $col2=$columnRight;  @endphp
  @break
  @case('3')
  @php $row="item-border"; $col1=$columnRight." order-1 px-0"; $col2=$columnLeft." order-0"; @endphp
  @break
@endswitch

<div id="{{$item->slug}}{{$item->id}}{{$d}}" class="item-layout item-list-layout-7 position-relative">

  <x-isite::edit-link link="{{$editLink}}{{$item->id}}" tooltip="{{$tooltipEditLink}}"/>
  <div class="card-item {{$row}}">
    <div class="{{$imagePosition!='1' ? 'row' : ''}}">
        @if(method_exists ( $item, "mediaFiles" ) )
          <div class="item-image {{$col1}} {{$imagePositionVertical}} @if($withImageOpacity) {{$imageOpacityColor}} {{$imageOpacityDirection}} @endif">
            <x-media::single-image :alt="$item->title ?? $item->name" :title="$item->title ?? $item->name" :
                                   :url="$item->url ?? null" :isMedia="true" width="100%" :target="$target"
                                   imgClasses="img-style"
                                   :mediaFiles="$item->mediaFiles()" :zone="$mediaImage ?? 'mainimage'"/>
          </div>
        @endif
        <div class="item-content {{$col2}} {{$contentPositionVertical}}">

          @if($withTitle)
                  <div class=" {{$orderClasses["title"] ?? 'order-1'}} item-title  ">
              @if(isset($item->url) && !empty($item->url))
                          <a href="{{$item->url}}" target="{{$target}}" class="{{$titleColor}}">
                  @endif
                              <h3 class="title d-flex align-items-center {{$titleAlign}} {{$titleTextWeight}} {{$titleTextTransform}} {{$titleMarginT}} {{$titleMarginB}} {{$contentMarginInsideX}}"  style="height: {{$titleHeight}}px;">
                                  @if($titleVineta) <i class="{{$titleVineta}} {{$titleVinetaColor}} mr-2"></i>  @endif
                                  <span> {{$item->title ?? $item->name}}</span>
                  </h3>
                  @if(isset($item->url) && !empty($item->url))
                </a>
              @endif
            </div>
          @endif
          @if($withCreatedDate && isset($item->created_at))
            <div class=" {{$orderClasses["date"] ?? 'order-2'}} item-created-date {{$createdDateAlign}}">
              @if(isset($item->url)&& !empty($item->url))
                <a href="{{$item->url}}" target="{{$target}}">
                  @endif
                  <div
                    class="created-date {{$createdDateTextWeight}} {{$createdDateColor}} {{$createdDateMarginT}} {{$createdDateMarginB}}">
                    {{ $item->created_at->format($formatCreatedDate) }}
                  </div>
                  @if(isset($item->url) && !empty($item->url))
                </a>
              @endif
            </div>
          @endif
          @if($withUser && ( isset($item->user)))
            <div class=" {{$orderClasses["user"] ?? 'order-3'}} item-user {{$userAlign}}">
              @if(isset($item->url)&& !empty($item->url))
                <a href="{{$item->url}}" target="{{$target}}">
                  @endif
                  <div
                    class="created-date {{$userTextWeight}} {{$userColor}} {{$userMarginT}} {{$userMarginB}}">
                    Por: {{$item->user->present()->fullname()}}
                  </div>
                  @if(isset($item->url) && !empty($item->url))
                </a>
              @endif
            </div>
          @endif
          @if($withCategory && isset($item->category->id))
            <div class=" {{$orderClasses["categoryTitle"] ?? 'order-4'}} item-category {{$categoryAlign}}">
              @if(isset($item->category->url) && !empty($item->category->url))
                <a href="{{$item->category->url}}" target="{{$target}}">
                  @endif
                  <h5 class="category {{$categoryTextWeight}} {{$categoryColor}} {{$categoryMarginT}} {{$categoryMarginB}}">
                    {{$item->category->title ?? $item->category->name}}
                  </h5>
                  @if(isset($item->category->url) && !empty($item->category->url))
                </a>
              @endif
            </div>
          @endif
          @if($withSummary && ( isset($item->summary) || isset($item->description) || isset($item->custom_html)) )
            <div class=" {{$orderClasses["summary"] ?? 'order-5'}} item-summary {{$summaryAlign}}">
              @if(isset($item->url) && !empty($item->url))
                <a href="{{$item->url}}" target="{{$target}}">
                  @endif
                              <div class="summary {{$summaryTextWeight}} {{$summaryColor}} {{$summaryMarginT}} {{$summaryMarginB}}" style="height: {{$summaryHeight}}px;">
                    {!! Str::limit( $item->summary ?? $item->description ?? $item->custom_html ?? '', $numberCharactersSummary) !!}
                  </div>
                  @if(isset($item->url) && !empty($item->url))
                </a>
              @endif
            </div>
          @endif
          @if($withViewMoreButton)
                  <div class="{{$orderClasses["viewMoreButton"] ?? 'order-5'}} item-view-more-button {{$buttonAlign}}">
              @if(isset($item->url) && !empty($item->url))
                          @if($viewMoreButtonLabel=="")
                              @php $labelExist= false; @endphp
                          @else
                              @php $labelExist= true; @endphp
                          @endif
                          <x-isite::button :style="$buttonLayout"
                                           :buttonClasses="$buttonSize.' view-more-button '.$buttonLayout.' '.$buttonMarginT.' '.$buttonMarginB.' '.$contentMarginInsideX"
                                           :href="$item->url"
                                           :withIcon="$buttonIconLR"
                                           :iconPosition="$buttonIconLR"
                                           :iconClass="$buttonIcon"
                                           :withLabel="$labelExist"
                                           :color="$buttonColor"
                                           :label="trans($viewMoreButtonLabel)"
                                           :target="$target"
                                           :sizeLabel="$buttonTextSize"
                                           :iconColor="$buttonIconColor"
                          />
              @endif
            </div>
          @endif

        </div>
    </div>
  </div>

    {{-- 1 all, 2 top, 3 right, 4 left, 5 bottom --}}
    @switch($imageBorderRadioType)
        @case('2')
        @php $imageRadio=$imageBorderRadio."px ".$imageBorderRadio."px 0 0";  @endphp
        @break
        @case('3')
        @php $imageRadio=$imageBorderRadio."px 0 0 ".$imageBorderRadio."px";  @endphp
        @break
        @case('4')
        @php $imageRadio="0 ".$imageBorderRadio."px ".$imageBorderRadio."px 0";  @endphp
        @break
        @case('5')
        @php $imageRadio="0 0 ".$imageBorderRadio."px ".$imageBorderRadio."px"; @endphp
        @break
        @default
        @php $imageRadio=$imageBorderRadio."px";  @endphp
        @break
    @endswitch
    {{-- 1 all, 2 top, 3 right, 4 left, 5 bottom --}}
    @switch($contentBorderRoundedType)
        @case('2')
        @php $contentRadio=$contentBorderRounded."px ".$contentBorderRounded."px 0 0";  @endphp
        @break
        @case('3')
        @php $contentRadio=$contentBorderRounded."px 0 0 ".$contentBorderRounded."px";  @endphp
        @break
        @case('4')
        @php $contentRadio="0 ".$contentBorderRounded."px ".$contentBorderRounded."px 0";  @endphp
        @break
        @case('5')
        @php $contentRadio="0 0 ".$contentBorderRounded."px ".$contentBorderRounded."px"; @endphp
        @break
        @default
        @php $contentRadio=$contentBorderRounded."px";  @endphp
        @break
    @endswitch
<style>
    #{{$item->slug}}{{$item->id}}{{$d}} .card-item {
        background-color: {{$itemBackgroundColor}};
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .card-item:hover {
        background-color: {{$itemBackgroundColorHover}};
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-image picture:before {
        border-radius: {{$imageRadio}};
        top: {{$imagePadding}}px;
        left: {{$imagePadding}}px;
        bottom: {{$imagePadding}}px;
        right: {{$imagePadding}}px;
    }
    @if($imagePadding==0)
        #{{$item->slug}}{{$item->id}}{{$d}} .item-image picture {
             display: block !important;
        }
        #{{$item->slug}}{{$item->id}}{{$d}} .img-style {
             border-radius: {{$imageRadio}};
             border-style: {{$imageBorderStyle}};
             border-width: {{$imageBorderWidth}}px;
             border-color: {{$imageBorderColor}};
             aspect-ratio: {{$imageAspect}};
             object-fit: {{$imageObject}};
         }
    @else
        #{{$item->slug}}{{$item->id}}{{$d}} .item-image picture {
             display: block !important;
             border-radius: {{$imageRadio}};
             border-style: {{$imageBorderStyle}};
             border-width: {{$imageBorderWidth}}px;
             border-color: {{$imageBorderColor}};
        }
        #{{$item->slug}}{{$item->id}}{{$d}} .img-style {
             aspect-ratio: {{$imageAspect}};
             object-fit: {{$imageObject}};
             border-radius: {{$imageRadio}};
             padding: {{$imagePadding}}px;
    @endif

    @if($contentBorderShadows=='none')
        #{{$item->slug}}{{$item->id}}{{$d}} .item-border {
            padding:{{$contentPadding + $imagePadding}}px;
            border-width: {{$contentBorder}}px;
            border-style: solid;
            border-color: {{$contentBorderColor}};
            border-radius: {{$contentRadio}};
        }
    @else
        #{{$item->slug}}{{$item->id}}{{$d}} .item-border {
            padding:{{$contentPadding + $imagePadding}}px;
            border-width: {{$contentBorder}}px;
            border-style: solid;
            border-color: {{$contentBorderColor}};
            border-radius: {{$contentRadio}};
            @if(!$contentBorderShadowsHover)
            box-shadow: {{$contentBorderShadows}};
            @endif
            margin: 10px 0;
        }
        @if($contentBorderShadowsHover)
        #{{$item->slug}}{{$item->id}}{{$d}} .item-border:hover {
            box-shadow: {{$contentBorderShadows}};
        }
        @endif

    @endif

    #{{$item->slug}}{{$item->id}}{{$d}} .item-title .title {
        font-size: {{$titleTextSize}}px;
        letter-spacing: {{$titleLetterSpacing}}px;
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-summary .summary {
        font-size: {{$summaryTextSize}}px;
        letter-spacing: {{$summaryLetterSpacing}}px;
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-category .category {
        font-size: {{$categoryTextSize}}px;
        letter-spacing: {{$categoryLetterSpacing}}px;
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-created-date .created-date {
        font-size: {{$createdDateTextSize}}px;
        letter-spacing: {{$createdDateLetterSpacing}}px;
    }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-title a:hover {
         text-decoration: {{$titleTextDecoration}};
     }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-summary a:hover {
         text-decoration: {{$summaryTextDecoration}};
     }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-category a:hover {
         text-decoration: {{$categoryTextDecoration}};
     }
    #{{$item->slug}}{{$item->id}}{{$d}} .item-created-date a:hover {
         text-decoration: {{$createdDateTextDecoration}};
     }
</style>
</div>


