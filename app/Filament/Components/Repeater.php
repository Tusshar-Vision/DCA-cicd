<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Actions\Action;

class Repeater extends \Filament\Forms\Components\Repeater
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->defaultItems(0);

        $this->afterStateHydrated(static function (Repeater $component, ?array $state): void {
            if (
                is_array($component->hydratedDefaultState) &&
                $component->shouldMergeHydratedDefaultStateWithChildComponentContainerStateAfterStateHydrated
            ) {
                $component->mergeHydratedDefaultStateWithChildComponentContainerState();
            }

            if (is_array($component->hydratedDefaultState)) {
                return;
            }

            $items = [];

            $simpleField = $component->getSimpleField();

            foreach ($state ?? [] as $itemData) {
                $items[$component->generateUuid()] = $simpleField ?
                    [$simpleField->getName() => $itemData] :
                    $itemData;
            }

            $component->state($items);
        });

        $this->registerActions([
            fn (Repeater $component): Action => $component->getAddAction(),
            fn (Repeater $component): Action => $component->getAddBetweenAction(),
            fn (Repeater $component): Action => $component->getCloneAction(),
            fn (Repeater $component): Action => $component->getCollapseAction(),
            fn (Repeater $component): Action => $component->getCollapseAllAction(),
            fn (Repeater $component): Action => $component->getDeleteAction(),
            fn (Repeater $component): Action => $component->getExpandAction(),
            fn (Repeater $component): Action => $component->getExpandAllAction(),
            fn (Repeater $component): Action => $component->getMoveDownAction(),
            fn (Repeater $component): Action => $component->getMoveUpAction(),
            fn (Repeater $component): Action => $component->getReorderAction(),
        ]);

        $this->mutateDehydratedStateUsing(static function (Repeater $component, ?array $state): array {
            if ($simpleField = $component->getSimpleField()) {
                return collect($state ?? [])
                    ->values()
                    ->pluck($simpleField->getName())
                    ->all();
            }

            return array_values($state ?? []);
        });
    }
}
