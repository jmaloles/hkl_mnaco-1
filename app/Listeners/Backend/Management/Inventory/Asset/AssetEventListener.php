<?php

namespace App\Listeners\Backend\Management\Inventory\Asset;

/**
* Class AssetEventListener.
*/
class AssetEventListener
{
   /**
   * @var string
   */
   private $history_slug = 'Asset';

   /**
   * @param $event
   */
   public function onCreated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withText('trans("history.backend.management.inventory.asset.created") <strong>{asset}</strong>')
      ->withIcon('plus')
      ->withClass('bg-green')
      ->withAssets([
         'asset_link' => ['admin.management.inventory.asset.show', $event->asset->name, $event->asset->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onUpdated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withText('trans("history.backend.management.inventory.asset.updated") <strong>{asset}</strong>')
      ->withIcon('save')
      ->withClass('bg-aqua')
      ->withAssets([
         'asset_link' => ['admin.management.inventory.asset.show', $event->asset->name, $event->asset->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withText('trans("history.backend.management.inventory.asset.deleted") <strong>{asset}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'asset_link' => ['admin.management.inventory.asset.show', $event->asset->name, $event->asset->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onRestored($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withText('trans("history.backend.management.inventory.asset.restored") <strong>{asset}</strong>')
      ->withIcon('refresh')
      ->withClass('bg-aqua')
      ->withAssets([
         'asset_link' => ['admin.management.inventory.asset.show', $event->asset->name, $event->asset->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onPermanentlyDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withText('trans("history.backend.management.inventory.asset.permanently_deleted") <strong>{asset}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'asset_string' => $event->asset->name,
      ])
      ->log();

      history()->withType($this->history_slug)
      ->withEntity($event->asset->id)
      ->withAssets([
         'asset_string' => $event->asset->name,
      ])
      ->updateUserLinkAssets();
   }

   /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   */
   public function subscribe($events)
   {
      $events->listen(
         \App\Events\Backend\Management\Inventory\Asset\AssetCreated::class,
         'App\Listeners\Backend\Management\Inventory\Asset\AssetEventListener@onCreated'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Asset\AssetUpdated::class,
         'App\Listeners\Backend\Management\Inventory\Asset\AssetEventListener@onUpdated'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Asset\AssetDeleted::class,
         'App\Listeners\Backend\Management\Inventory\Asset\AssetEventListener@onDeleted'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Asset\AssetRestored::class,
         'App\Listeners\Backend\Management\Inventory\Asset\AssetEventListener@onRestored'
      );

      $events->listen(
         \App\Events\Backend\Management\Inventory\Asset\AssetPermanentlyDeleted::class,
         'App\Listeners\Backend\Management\Inventory\Asset\AssetEventListener@onPermanentlyDeleted'
      );
   }
}
