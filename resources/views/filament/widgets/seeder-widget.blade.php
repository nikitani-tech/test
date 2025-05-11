<x-filament::widget>
    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default] fi-wi-widget fi-wi-stats-overview grid gap-y-4">
        <x-filament::card>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Seeder</h3>
            <form wire:submit.prevent="runProductSeeder" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <x-filament::grid cols="2" gap="6">
                    <!-- Products Count -->
                    <div class="formInput">
                        <label for="productsCount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Count</label>
                        <input type="number" wire:model="productsCount" id="productsCount" min="1" step="1"
                               class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 focus:ring focus:ring-blue-500">
                    </div>
                    <!-- Add Image -->
                    <div class="flex items-center gap-3 formInput">
                        <input type="checkbox" wire:model="addImage" id="addImage"
                               class="h-5 w-5 text-blue-600 dark:text-blue-400 border-gray-300 rounded focus:ring focus:ring-blue-500">
                        <label for="addImage" class="text-sm font-medium text-gray-700 dark:text-gray-300">Add Product Image</label>
                    </div>
                </x-filament::grid>

                <div class="mt-6 flex justify-end relative">
                    <x-filament::button type="submit" color="primary" wire:loading.remove>
                        Run Seeder
                    </x-filament::button>

                    <!-- Loader -->
                    <div wire:loading class="flex items-center">
                        <x-filament::button type="submit" color="primary">
                            <svg class="animate-spin h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </x-filament::button>
                    </div>
                </div>

                <style>
                    .formInput{
                        margin: 10px 0;
                    }
                </style>
            </form>
        </x-filament::card>
    </div>
</x-filament::widget>
