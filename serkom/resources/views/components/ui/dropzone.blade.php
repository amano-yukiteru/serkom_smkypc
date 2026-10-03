@props([
    'name' => 'files',
    'label' => null,
    'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml,video/mp4,video/webm,video/quicktime',
    'multiple' => true,
    'maxFiles' => 10,
    'maxSize' => 5,
    'hint' => null,
    'required' => false,
])

@php
    $hasError = $errors->has($name);
    $uid = 'dz-' . Str::random(8);
@endphp

<div
    class="w-full"
    x-data="dropzoneHandler({
        maxFiles: {{ $maxFiles }},
        maxSize: {{ $maxSize * 1024 * 1024 }}
    })"
    data-dropzone="{{ $uid }}"
>
    @if($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    {{-- Drop Zone --}}
    <div
        @drop.prevent="handleDrop($event)"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @click="$refs.fileInput.click()"
        :class="isDragging
            ? 'border-brand-500 bg-brand-50/50 dark:bg-brand-500/5'
            : 'border-gray-300 bg-gray-50 hover:border-brand-500 dark:border-gray-700 dark:bg-gray-900'"
        class="cursor-pointer rounded-xl border border-dashed p-7 transition-colors lg:p-10
            {{ $hasError ? 'border-red-500 bg-red-50/50 dark:border-red-500 dark:bg-red-500/5' : '' }}"
    >
        <input
            x-ref="fileInput"
            type="file"
            name="{{ $name }}"
            accept="{{ $accept }}"
            @if($multiple) multiple @endif
            class="hidden"
            @change="handleFiles(Array.from($event.target.files))"
            @if($required) required @endif
        />

        <div class="flex flex-col items-center text-center">
            {{-- Icon Circle --}}
            <div
                class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-gray-200 text-gray-700 transition dark:bg-gray-800 dark:text-gray-400"
                :class="isDragging && 'bg-brand-500 text-white dark:bg-brand-500'"
            >
                <svg class="h-7 w-7" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5019 3.91699C14.2852 3.91699 14.0899 4.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z" fill="currentColor"/>
                </svg>
            </div>

            <h4 class="mb-2 text-lg font-semibold text-gray-800 dark:text-white/90">
                <span x-show="!isDragging">Drag & Drop Files Here</span>
                <span x-show="isDragging" x-cloak class="text-brand-500">Drop Files Here</span>
            </h4>

            <p class="mb-4 block w-full max-w-[290px] text-sm text-gray-500 dark:text-gray-400">
                Drag and drop your images or videos here or browse
            </p>

            <span class="text-sm font-medium text-brand-500 underline underline-offset-2 hover:text-brand-600">
                Browse File
            </span>
        </div>
    </div>

    @if($hint && !$hasError)
        <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
    @enderror

    <p x-show="errorMsg" x-text="errorMsg" x-cloak class="mt-2 text-xs text-red-500"></p>

    {{-- File Preview List --}}
    <div x-show="files.length > 0" x-cloak class="mt-4 space-y-2">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">
            File terpilih: <span x-text="files.length"></span>
        </p>

        <template x-for="(file, index) in files" :key="index">
            <div class="flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-md bg-gray-200 dark:bg-gray-700">
                    <template x-if="previews[index] && previews[index].type.startsWith('image/')">
                        <img :src="previews[index].url" class="h-full w-full object-cover" />
                    </template>
                    <template x-if="previews[index] && previews[index].type.startsWith('video/')">
                        <video :src="previews[index].url" class="h-full w-full object-cover" muted></video>
                    </template>
                    <template x-if="previews[index] && !previews[index].type.startsWith('image/') && !previews[index].type.startsWith('video/')">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </template>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-medium text-gray-700 dark:text-gray-300" x-text="file.name"></p>
                    <p class="text-xs text-gray-400" x-text="formatSize(file.size)"></p>
                </div>

                <button
                    type="button"
                    @click.stop="removeFile(index)"
                    class="shrink-0 rounded-md p-1 text-red-500 transition hover:bg-red-50 dark:hover:bg-red-500/10"
                    title="Hapus"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>

@push('scripts')
<script>
    function dropzoneHandler(config) {
        return {
            isDragging: false,
            files: [],
            previews: [],
            maxFiles: config.maxFiles,
            maxSize: config.maxSize,
            errorMsg: '',

            handleDrop(e) {
                this.isDragging = false;
                const droppedFiles = Array.from(e.dataTransfer.files);
                this.handleFiles(droppedFiles);
            },

            handleFiles(selectedFiles) {
                this.errorMsg = '';

                const validFiles = selectedFiles.filter(file => {
                    if (file.size > this.maxSize) {
                        this.errorMsg = `File "${file.name}" melebihi batas ${config.maxSize / 1024 / 1024}MB.`;
                        return false;
                    }
                    return true;
                });

                if (this.files.length + validFiles.length > this.maxFiles) {
                    this.errorMsg = `Maksimal ${this.maxFiles} file.`;
                    return;
                }

                validFiles.forEach(file => {
                    this.files.push(file);
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previews.push({
                            url: e.target.result,
                            type: file.type,
                        });
                    };
                    reader.readAsDataURL(file);
                });

                this.syncInput();
            },

            removeFile(index) {
                this.files.splice(index, 1);
                this.previews.splice(index, 1);
                this.syncInput();
            },

            syncInput() {
                const dt = new DataTransfer();
                this.files.forEach(f => dt.items.add(f));
                this.$refs.fileInput.files = dt.files;
            },

            formatSize(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1024 / 1024).toFixed(2) + ' MB';
            }
        };
    }
</script>
@endpush