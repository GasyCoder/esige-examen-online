<div>

    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Favorite Color</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @forelse ($classes as $classe)
                  <tr>
                    <th>1</th>
                    <td>Cy Ganderton</td>
                    <td>Quality Control Specialist</td>
                    <td>Blue</td>
                </tr>      
                @empty
                    <div>Aucun data</div>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <h1>Classes</h1>
    <div>
        <x-mary-form wire:submit="save">
            <x-mary-input label="Name" wire:model="name" />
           <x-mary-markdown wire:model="sigle" label="Blog post" />
        
            <x-slot:actions>
                <x-mary-button label="Cancel" />
                <x-mary-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </div>
</div>
