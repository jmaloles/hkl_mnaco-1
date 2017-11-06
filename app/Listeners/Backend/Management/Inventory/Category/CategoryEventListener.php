<?php

namespace App\Listeners\Backend\Management\Inventory\Category;

/**
* Class CategoryEventListener.
*/
class CategoryEventListener
{
   /**
   * @var string
   */
   private $history_slug = 'Category';

   /**
   * @param $event
   */
   public function onCreated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withText('trans("history.backend.management.inventory.category.created") <strong>{category}</strong>')
      ->withIcon('plus')
      ->withClass('bg-green')
      ->withAssets([
         'category_link' => ['admin.management.inventory.category.show', $event->category->name, $event->category->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onUpdated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withText('trans("history.backend.management.inventory.category.updated") <strong>{category}</strong>')
      ->withIcon('save')
      ->withClass('bg-aqua')
      ->withAssets([
         'category_link' => ['admin.management.inventory.category.show', $event->category->name, $event->category->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withText('trans("history.backend.management.inventory.category.deleted") <strong>{category}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'category_link' => ['admin.management.inventory.category.show', $event->category->name, $event->category->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onRestored($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withText('trans("history.backend.management.inventory.category.restored") <strong>{category}</strong>')
      ->withIcon('refresh')
      ->withClass('bg-aqua')
      ->withAssets([
         'category_link' => ['admin.management.inventory.category.show', $event->category->name, $event->category->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onPermanentlyDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withText('trans("history.backend.management.inventory.category.permanently_deleted") <strong>{category}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'category_string' => $event->category->name,
      ])
      ->log();

      history()->withType($this->history_slug)
      ->withEntity($event->category->id)
      ->withAssets([
         'category_string' => $event->category->name,
      ])
      ->updateUserLinkCategories();
   }

   /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   */
   public function subscribe($events)
   {
      $events->listen(
         \App\Events\Backend\Management\Inventory\Category\CategoryCreated::class,
         'App\Listeners\Backend\Management\Inventory\Category\CategoryEventListener@onCreated'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Category\CategoryUpdated::class,
         'App\Listeners\Backend\Management\Inventory\Category\CategoryEventListener@onUpdated'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Category\CategoryDeleted::class,
         'App\Listeners\Backend\Management\Inventory\Category\CategoryEventListener@onDeleted'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Category\CategoryRestored::class,
         'App\Listeners\Backend\Management\Inventory\Category\CategoryEventListener@onRestored'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Category\CategoryPermanentlyDeleted::class,
         'App\Listeners\Backend\Management\Inventory\Category\CategoryEventListener@onPermanentlyDeleted'
      );
   }
}
