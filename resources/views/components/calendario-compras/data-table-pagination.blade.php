<div class="text-mtv-secondary font-bold flex flex-row my-4 justify-center items-center">
    <button type="button" @click="$data.changePage($data.currentPage - 1)">
        @svg('fas-arrow-left', ['class' => 'w-4 h-4 mr-4'])
    </button>
    <span>
        <span x-text="$data.currentPage"></span> de <span x-text="$data.pagination.lastPage"></span>
    </span>
    <button type="button" @click="$data.changePage($data.currentPage + 1)">
        @svg('fas-arrow-right', ['class' => 'w-4 h-4 ml-4'])
    </button>
</div>