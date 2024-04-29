<span class="dropdown dropstart">
    <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="courseDropdown{{ $model->id }}"
        data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
        <i class="fe fe-more-vertical"></i>
    </a>
    <span class="dropdown-menu" aria-labelledby="courseDropdown{{ $model->id }}">
        <span class="dropdown-header">Actions</span>
        <button wire:click="edit({{ $model->id }})" class="dropdown-item" data-bs-toggle="modal" href="#editPro"
            role="button">
            <i class="fe fe-plus-circle dropdown-item-icon"></i>
            Modifier
        </button>
        <button class="dropdown-item" wire:click="delete({{ $model->id }})">
            <i class="fe fe-trash dropdown-item-icon"></i>
            Corbeille
        </button>
    </span>
</span>