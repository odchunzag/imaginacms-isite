<?php

namespace Modules\Isite\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{


  public $items;
  public $view;
  public $itemLayout;
  public $id;
  public $repository;
  public $layout;
  public $title;
  public $params;
  public $menuBefore;
  public $menuAfter;
  public $withHome;
  public $homeIcon;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($repository, $id, $params = [], $layout = 'category-menu-layout-1', $title = "Categorías",
                              $menuBefore = null, $menuAfter = null, $withHome = true, $homeIcon = "")
  {
    $this->id = $id;
    $this->repository = $repository;
    $this->params = $params;
    $this->layout = $layout;
    $this->title = $title;
    $this->menuBefore = $menuBefore;
    $this->menuAfter = $menuAfter;
    $this->withHome = $withHome;
    $this->homeIcon = $homeIcon ?? "fa fa-home";

    $this->view = "isite::frontend.components.category-menu.layouts.{$layout}.index";

    $this->getItems();
  }

  private function makeParamsFunction(){

    return [
      "include" => $this->params["include"] ?? ["children"],
      "take" => $this->params["take"] ?? false,
      "page" => $this->params["page"] ?? 1,
      "filter" => $this->params["filter"] ?? ["showMenu" => true,"parentId" => 0],
      "order" => $this->params["order"] ?? null
    ];
  }

  private function getItems(){

    $params = $this->makeParamsFunction();

    $this->items = app($this->repository)->getItemsBy(json_decode(json_encode($params)));

  }
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view($this->view);
  }
}
