# Biblioteca de Componentes — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Componentes construídos com **Blade + Tailwind CSS v4 + Alpine.js**.
Organizados em: **Base** (átomos), **Compostos** (moléculas), **Layout** (organismos), **Templates** (páginas).

Localização: `resources/views/components/`

---

## 1. Componentes Base (Átomos)

### Button (`components/button.blade.php`)

```blade
@props([
    'variant' => 'primary', // primary, secondary, outline, ghost, destructive, success
    'size' => 'md',         // sm, md, lg, icon
    'disabled' => false,
    'loading' => false,
    'type' => 'button',     // button, submit, reset
    'as' => 'button',       // button, a
    'href' => null,         // se as="a"
    'fullWidth' => false,
])

<?php
$variants = [
    'primary' => 'bg-primary-500 text-white hover:bg-primary-600 focus:ring-primary-500',
    'secondary' => 'bg-white border border-primary-500 text-primary-500 hover:bg-primary-50 focus:ring-primary-500',
    'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500',
    'ghost' => 'text-gray-600 hover:bg-gray-100 focus:ring-gray-500',
    'destructive' => 'bg-error-500 text-white hover:bg-error-600 focus:ring-error-500',
    'success' => 'bg-success-500 text-white hover:bg-success-600 focus:ring-success-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm gap-1.5',
    'md' => 'px-4 py-2 text-base gap-2',
    'lg' => 'px-6 py-3 text-lg gap-2.5',
    'icon' => 'p-2',
];

$classes = [
    'inline-flex items-center justify-center font-medium rounded-md transition-all duration-150',
    'focus:outline-none focus:ring-2 focus:ring-offset-2',
    'disabled:opacity-50 disabled:cursor-not-allowed',
    $variants[$variant] ?? $variants['primary'],
    $sizes[$size] ?? $sizes['md'],
    $fullWidth ? 'w-full' : '',
];

$tag = $as;
$attributes = array_merge(['type' => $type], $attributes->except(['variant','size','disabled','loading','type','as','href','fullWidth']));
if ($as === 'a') {
    $attributes['href'] = $href;
    unset($attributes['type']);
}
?>

<{{ $tag }} {{ $attributes->class(implode(' ', $classes)) }}>
    @if($loading)
        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
        <span>{{ $loading }}</span>
    @else
        {{ $slot }}
    @endif
</{{ $tag }}>
```

**Uso:**
```blade
<x-button variant="primary" size="md" wire:click="save">Salvar</x-button>
<x-button variant="destructive" wire:click.confirm="delete">Excluir</x-button>
<x-button variant="ghost" size="sm" as="a" href="/jobs">Ver todos</x-button>
<x-button loading="A processar..." disabled>Processando</x-button>
```

---

### Input (`components/input.blade.php`)

```blade
@props([
    'id' => null,
    'name' => null,
    'type' => 'text', // text, email, password, tel, number, textarea, select, file
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'error' => null,
    'helper' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => 'off',
    'maxlength' => null,
    'minlength' => null,
    'step' => null,
    'min' => null,
    'max' => null,
    'options' => [], // para select
    'multiple' => false,
    'accept' => null, // para file
    'wireModel' => null, // Livewire
    'xModel' => null,    // Alpine
])

<?php
$inputId = $id ?? $name ?? 'input-' . uniqid();
$classes = [
    'w-full rounded-md border transition-colors duration-150',
    'bg-white text-gray-900 placeholder-gray-400',
    'focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:ring-offset-0',
    'disabled:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-70',
    'error' => 'border-error-500 focus:ring-error-500 focus:border-error-500',
    'default' => 'border-gray-300',
];

$inputClasses = implode(' ', array_filter([
    $classes['default'],
    $error ? $classes['error'] : '',
]));
?>

<div class="w-full">
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-1.5">
            {{ $label }}
            @if($required) <span class="text-error-500 ml-1" aria-hidden="true">*</span> @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $inputId }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => $inputClasses, 'rows' => 4]) }}
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($xModel) x-model="{{ $xModel }}" @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($required) required @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
        >{{ $value ?? old($name) }}</textarea>
    @elseif($type === 'select')
        <select
            id="{{ $inputId }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => $inputClasses . ' appearance-none bg-no-repeat bg-right pr-10']) }}
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($xModel) x-model="{{ $xModel }}" @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            @if($multiple) multiple @endif
        >
            @if(!empty($options) && !$multiple)
                <option value="">Selecione...</option>
            @endif
            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ (old($name, $value) == $value) ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    @elseif($type === 'file')
        <input
            type="file"
            id="{{ $inputId }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100']) }}
            @if($accept) accept="{{ $accept }}" @endif
            @if($multiple) multiple @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
        >
    @else
        <input
            type="{{ $type }}"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            {{ $attributes->merge(['class' => $inputClasses]) }}
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($xModel) x-model="{{ $xModel }}" @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($required) required @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
            @if($step) step="{{ $step }}" @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
        >
    @endif

    @if($error)
        <p class="mt-1.5 text-sm text-error-500" role="alert">{{ $error }}</p>
    @elseif($helper)
        <p class="mt-1.5 text-sm text-gray-500">{{ $helper }}</p>
    @endif
</div>
```

---

### Badge (`components/badge.blade.php`)

```blade
@props([
    'variant' => 'default', // default, primary, success, warning, error, accent, highlight
    'size' => 'md',         // sm, md, lg
    'dot' => false,         // indicador de status (online/offline)
    'removable' => false,   // chip com X
    'onRemove' => null,     // callback Alpine/Livewire
])

<?php
$variants = [
    'default' => 'bg-gray-100 text-gray-700',
    'primary' => 'bg-primary-100 text-primary-700',
    'success' => 'bg-success-100 text-success-700',
    'warning' => 'bg-warning-100 text-warning-700',
    'error' => 'bg-error-100 text-error-700',
    'accent' => 'bg-accent-100 text-accent-700',
    'highlight' => 'bg-highlight-100 text-highlight-700',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs gap-1',
    'md' => 'px-2.5 py-1 text-sm gap-1.5',
    'lg' => 'px-3 py-1 text-base gap-2',
];

$classes = [
    'inline-flex items-center font-medium rounded-full',
    $variants[$variant] ?? $variants['default'],
    $sizes[$size] ?? $sizes['md'],
];
?>

<span {{ $attributes->class(implode(' ', $classes)) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full bg-current opacity-70" aria-hidden="true"></span>
    @endif
    {{ $slot }}
    @if($removable)
        <button
            type="button"
            @click="{{ $onRemove }}"
            class="ml-1 p-0.5 rounded hover:bg-black/10 focus:outline-none focus:ring-2 focus:ring-current"
            aria-label="Remover"
        >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    @endif
</span>
```

**Status Badges (Domain-Specific):**
```blade
<x-badge variant="success" dot>Concluído</x-badge>
<x-badge variant="warning" dot>Em andamento</x-badge>
<x-badge variant="error" dot>Cancelado</x-badge>
<x-badge variant="warning">Retido</x-badge>
<x-badge variant="success">Liberado</x-badge>
<x-badge variant="error">Devolvido</x-badge>
<x-badge variant="accent" dot>Boost Ativo</x-badge>
```

---

### Avatar (`components/avatar.blade.php`)

```blade
@props([
    'src' => null,
    'alt' => '',
    'name' => null,        // para fallback inicials
    'size' => 'md',        // xs, sm, md, lg, xl, 2xl
    'shape' => 'circle',   // circle, square
    'status' => null,      // online, offline, busy, away
    'statusSize' => 'sm',  // sm, md, lg
    'statusPosition' => 'bottom-right', // bottom-right, top-right, bottom-left
])

<?php
$sizes = [
    'xs' => 'w-6 h-6 text-xs',
    'sm' => 'w-8 h-8 text-sm',
    'md' => 'w-10 h-10 text-base',
    'lg' => 'w-12 h-12 text-lg',
    'xl' => 'w-16 h-16 text-xl',
    '2xl' => 'w-24 h-24 text-2xl',
];

$statusSizes = [
    'sm' => 'w-2.5 h-2.5',
    'md' => 'w-3 h-3',
    'lg' => 'w-4 h-4',
];

$statusColors = [
    'online' => 'bg-success-500',
    'offline' => 'bg-gray-400',
    'busy' => 'bg-warning-500',
    'away' => 'bg-accent-500',
];

$positions = [
    'bottom-right' => 'bottom-0 right-0',
    'top-right' => 'top-0 right-0',
    'bottom-left' => 'bottom-0 left-0',
];

$initials = $name ? collect(explode(' ', $name))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->implode('') : '?';
?>

<div class="relative inline-flex shrink-0" {{ $attributes->merge(['class' => $sizes[$size] ?? $sizes['md']]) }}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt ?: $name }}" class="w-full h-full object-cover {{ $shape === 'circle' ? 'rounded-full' : 'rounded-md' }}" loading="lazy">
    @else
        <div class="w-full h-full {{ $shape === 'circle' ? 'rounded-full' : 'rounded-md' }} bg-primary-100 flex items-center justify-center text-primary-700 font-medium">
            {{ Str::upper($initials) }}
        </div>
    @endif

    @if($status)
        <span
            class="absolute {{ $positions[$statusPosition] ?? 'bottom-0 right-0' }} {{ $statusSizes[$statusSize] ?? 'w-2.5 h-2.5' }} {{ $statusColors[$status] ?? 'bg-gray-400' }} rounded-full border-2 border-white"
            aria-label="{{ ucfirst($status) }}"
        ></span>
    @endif
</div>
```

---

### Card (`components/card.blade.php`)

```blade
@props([
    'variant' => 'outlined', // outlined, elevated, filled, interactive
    'padding' => 'md',       // none, sm, md, lg
    'hover' => false,
])

<?php
$variants = [
    'outlined' => 'border border-gray-200 bg-white',
    'elevated' => 'shadow-md bg-white border-0',
    'filled' => 'bg-gray-50 border-0',
    'interactive' => 'border border-gray-200 bg-white hover:shadow-lg cursor-pointer transition-shadow duration-200',
];

$paddings = [
    'none' => '',
    'sm' => 'p-4',
    'md' => 'p-6',
    'lg' => 'p-8',
];
?>

<div {{ $attributes->class(trim(implode(' ', [
    'rounded-lg',
    $variants[$variant] ?? $variants['outlined'],
    $paddings[$padding] ?? $paddings['md'],
])) }}>
    {{ $slot }}
</div>
```

**Sub-componentes:**
```blade
<x-card>
    <x-slot name="header">
        <x-card.header>Título</x-card.header>
    </x-slot>
    <x-slot name="content">Conteúdo</x-slot>
    <x-slot name="footer">Ações</x-slot>
</x-card>
```

---

### Modal (`components/modal.blade.php`)

```blade
@props([
    'open' => false,
    'title' => null,
    'description' => null,
    'size' => 'md',        // sm, md, lg, xl, full
    'closeable' => true,   // ESC, backdrop click, botão fechar
    'persistent' => false, // não fecha no ESC/backdrop
])

<?php
$sizes = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    'full' => 'max-w-4xl',
?>
@if($open)
    <!-- Backdrop -->
    <div
        class="fixed inset-0 z-50 overflow-y-auto"
        @if(!$persistent) wire:click.self="$set('open', false)" @endif
        aria-hidden="true"
    >
        <div class="fixed inset-0 bg-black/50 transition-opacity" aria-hidden="true"></div>

        <!-- Modal -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div
                class="relative w-full {{ $sizes[$size] ?? 'max-w-md' }} bg-white rounded-xl shadow-xl transform transition-all"
                role="dialog"
                aria-modal="true"
                @if($title) aria-labelledby="modal-title" @endif
                @if($description) aria-describedby="modal-description" @endif
            >
                @if($title || $closeable)
                    <div class="flex items-start justify-between p-6 border-b border-gray-100">
                        <div>
                            @if($title)
                                <h2 id="modal-title" class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
                            @endif
                            @if($description)
                                <p id="modal-description" class="mt-1 text-sm text-gray-500">{{ $description }}</p>
                            @endif
                        </div>
                        @if($closeable)
                            <button
                                type="button"
                                @if($persistent) wire:click="$set('open', false)" @else wire:click="$set('open', false)" @endif
                                class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg p-1"
                                aria-label="Fechar"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        @endif
                    </div>
                @endif

                <div class="p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endif
```

**Confirm Dialog (Especializado):**
```blade
<x-modal.confirm
    :open="$showConfirm"
    title="Confirmar exclusão"
    description="Esta ação não pode ser desfeita. Tem certeza?"
    confirmText="Sim, excluir"
    confirmVariant="destructive"
    cancelText="Cancelar"
    :onConfirm="confirmDelete"
    :onCancel="$set('showConfirm', false)"
/>
```

---

### Toast (`components/toast.blade.php` + Alpine Store)

```blade
<!-- resources/views/components/toast.blade.php -->
@props([
    'id' => null,
    'type' => 'info',     // success, error, warning, info
    'title' => null,
    'message' => null,
    'duration' => 5000,   // ms, 0 = não auto-close
    'action' => null,     // { label, onClick }
])

<?php
$types = [
    'success' => ['bg' => 'bg-success-500', 'icon' => 'check-circle', 'border' => 'border-success-500'],
    'error' => ['bg' => 'bg-error-500', 'icon' => 'x-circle', 'border' => 'border-error-500'],
    'warning' => ['bg' => 'bg-warning-500', 'icon' => 'alert-triangle', 'border' => 'border-warning-500'],
    'info' => ['bg' => 'bg-primary-500', 'icon' => 'info', 'border' => 'border-primary-500'],
];
$t = $types[$type] ?? $types['info'];
?>

<div
    id="{{ $id ?? 'toast-' . uniqid() }}"
    class="flex items-start gap-3 p-4 rounded-lg shadow-lg border-l-4 {{ $t['border'] }} {{ $t['bg'] }} text-white min-w-[300px] max-w-md animate-slide-in-right"
    role="alert"
    aria-live="polite"
    x-data="{ autoClose: {{ $duration > 0 ? 'true' : 'false' }}, duration: {{ $duration }} }"
    x-init="autoClose && setTimeout(() => $el.remove(), duration)"
>
    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        @if($type === 'success')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        @elseif($type === 'error')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-2 2l-2-2m2 2l2 2m-2 2l2 2"/>
        @elseif($type === 'warning')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        @else
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        @endif
    </svg>

    <div class="flex-1 min-w-0">
        @if($title)
            <p class="text-sm font-semibold">{{ $title }}</p>
        @endif
        @if($message)
            <p class="text-sm opacity-90 mt-0.5">{{ $message }}</p>
        @endif
    </div>

    <button
        type="button"
        class="flex-shrink-0 text-white/70 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/50 rounded p-1"
        @click="$el.remove()"
        aria-label="Fechar"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    @if($action)
        <button
            type="button"
            class="flex-shrink-0 mt-2 text-sm font-medium underline hover:no-underline"
            wire:click="{{ $action['onClick'] }}"
        >
            {{ $action['label'] }}
        </button>
    @endif
</div>
```

**Alpine Toast Store (`resources/js/toast.js`):**
```javascript
// Uso: Alpine.store('toast').success('Título', 'Mensagem')
Alpine.store('toast', {
    toasts: [],
    add(type, title, message, options = {}) {
        const id = `toast-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
        this.toasts.push({ id, type, title, message, ...options });
        if (options.duration !== 0) {
            setTimeout(() => this.remove(id), options.duration || 5000);
        }
    },
    remove(id) {
        this.toasts = this.toasts.filter(t => t.id !== id);
    },
    success(title, message, options) { this.add('success', title, message, options); },
    error(title, message, options) { this.add('error', title, message, options); },
    warning(title, message, options) { this.add('warning', title, message, options); },
    info(title, message, options) { this.add('info', title, message, options); },
});
```

**Container Global (`layouts/app.blade.php`):**
```blade
<div x-data x-init="Alpine.store('toast').toasts.forEach(t => $dispatch('toast-add', t))" @toast-add.window="toasts.push($event.detail)">
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-2 w-80 pointer-events-none">
        <template x-for="toast in $store.toast.toasts" :key="toast.id">
            <x-toast
                :id="toast.id"
                :type="toast.type"
                :title="toast.title"
                :message="toast.message"
                :duration="toast.duration"
                :action="toast.action"
            />
        </template>
    </div>
</div>
```

---

## 2. Componentes Compostos (Moléculas)

### JobCard (`components/job-card.blade.php`)

```blade
@props([
    'job' => null,           // Job model
    'variant' => 'default',  // default, compact, featured
    'showClient' => true,
    'showActions' => true,
    'currentUserRole' => null, // cliente, freelancer
])

<?php
$statusVariants = [
    'rascunho' => 'default',
    'aberto' => 'primary',
    'em_andamento' => 'accent',
    'concluido' => 'success',
    'cancelado' => 'error',
    'arquivado' => 'default',
];
?>

<x-card variant="interactive" class="flex flex-col h-full">
    <div class="flex items-start gap-3">
        @if($job->categoria && $job->categoria->url_icone)
            <img src="{{ $job->categoria->url_icone }}" alt="" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
        @else
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        @endif

        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h3 class="font-semibold text-gray-900 truncate">{{ $job->titulo }}</h3>
                <x-badge :variant="$statusVariants[$job->status] ?? 'default'">{{ ucfirst(str_replace('_', ' ', $job->status)) }}</x-badge>
                @if($job->esta_destacado) <x-badge variant="highlight">Destaque</x-badge> @endif
                @if($job->is_urgent) <x-badge variant="accent">Urgente</x-badge> @endif
                @if($job->is_remote) <x-badge variant="default" dot>Remoto</x-badge> @endif
            </div>

            <p class="mt-1.5 text-sm text-gray-600 line-clamp-2">{{ $job->descricao }}</p>

            <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                @if($job->tipo_trabalho === 'preco_fixo')
                    <span class="font-semibold text-gray-900">{{ number_format($job->orcamento_fixo, 0, ',', '.') }} Kz</span>
                @else
                    <span class="font-semibold text-gray-900">{{ number_format($job->taxa_hora_min, 0, ',', '.') }} - {{ number_format($job->taxa_hora_max, 0, ',', '.') }} Kz/h</span>
                @endif

                @if($job->prazo)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $job->prazo->diffForHumans() }}
                    </span>
                @endif

                @if($job->nivel_experiencia)
                    <span class="px-2 py-0.5 bg-gray-100 rounded-full">{{ ucfirst($job->nivel_experiencia) }}</span>
                @endif
            </div>

            @if($job->skills->count())
                <div class="mt-2 flex flex-wrap gap-1.5">
                    @foreach($job->skills->take(4) as $skill)
                        <x-badge variant="primary" size="sm">{{ $skill->nome }}</x-badge>
                    @endforeach
                    @if($job->skills->count() > 4)
                        <x-badge variant="default" size="sm">+{{ $job->skills->count() - 4 }}</x-badge>
                    @endif
                </div>
            @endif
        </div>

        @if($showClient && $job->client)
            <x-avatar :src="$job->client->url_avatar" :name="$job->client->nome_completo" size="sm" :status="$job->client->esta_ativo ? 'online' : 'offline'" class="flex-shrink-0 ml-3" />
        @endif
    </div>

    @if($showActions)
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <x-badge variant="default" size="sm">{{ $job->proposals_count ?? 0 }} propostas</x-badge>
                @if($job->contagem_visualizacoes > 0)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7z"/></svg>
                        {{ $job->contagem_visualizacoes }}
                    </span>
                @endif
            </div>

            <div class="flex items-center gap-2">
                @if($currentUserRole === 'freelancer')
                    <x-button size="sm" variant="primary" wire:click="openProposalModal({{ $job->id }})">
                        Enviar Proposta
                    </x-button>
                @elseif($currentUserRole === 'cliente' && $job->cliente_id === auth()->id())
                    <x-button size="sm" variant="ghost" href="{{ url('/jobs/' . $job->id) }}">Ver</x-button>
                    @if($job->status === 'rascunho')
                        <x-button size="sm" variant="primary" href="{{ url('/jobs/' . $job->id . '/edit') }}">Editar</x-button>
                    @endif
                @else
                    <x-button size="sm" variant="primary" href="{{ url('/jobs/' . $job->id) }}">Ver Detalhes</x-button>
                @endif
            </div>
        </div>
    @endif
</div>
```

---

### ProposalCard (`components/proposal-card.blade.php`)

```blade
@props([
    'proposal' => null,
    'variant' => 'received', // received (cliente), sent (freelancer)
    'showActions' => true,
])

<x-card variant="outlined" padding="md">
    <div class="flex items-start gap-4">
        <x-avatar :src="$proposal->freelancer->url_avatar" :name="$proposal->freelancer->nome_completo" size="md" />

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2">
                <div>
                    <h4 class="font-semibold text-gray-900">{{ $proposal->freelancer->nome_completo }}</h4>
                    <p class="text-sm text-gray-500">@{{ $proposal->freelancer->nome_usuario }} · {{ $proposal->freelancer->avaliacao_media ?: 'Sem avaliações' }} <x-badge variant="default" size="sm">{{ $proposal->freelancer->total_avaliacoes }} avaliações</x-badge></p>
                </div>
                <x-badge :variant="[
                    'pendente' => 'warning',
                    'aceita' => 'success',
                    'rejeitada' => 'error',
                ][$proposal->status] ?? 'default'">{{ ucfirst($proposal->status) }}</x-badge>
            </div>

            <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $proposal->carta_apresentacao }}</p>

            <div class="mt-3 flex flex-wrap items-center gap-4 text-sm">
                <span class="font-semibold text-gray-900">{{ number_format($proposal->valor_proposto, 0, ',', '.') }} Kz</span>
                <span class="flex items-center gap-1 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $proposal->dias_entrega }} dias
                </span>
                <x-badge variant="primary" size="sm">{{ $proposal->creditos_gastos }} crédito{{ $proposal->creditos_gastos > 1 ? 's' : '' }}</x-badge>
            </div>

            @if($proposal->freelancer->portfolio_items->count())
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-500 mb-2">Portfólio</p>
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @foreach($proposal->freelancer->portfolio_items->take(4) as $item)
                            @if($item->url_imagem)
                                <img src="{{ $item->url_imagem }}" alt="{{ $item->titulo }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($showActions && $variant === 'received' && $proposal->status === 'pendente')
        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end gap-2">
            <x-button size="sm" variant="ghost" wire:click="rejectProposal({{ $proposal->id }})">Rejeitar</x-button>
            <x-button size="sm" variant="primary" wire:click="acceptProposal({{ $proposal->id }})">Aceitar</x-button>
        </div>
    @endif
</div>
```

---

### MessageBubble (`components/message-bubble.blade.php`)

```blade
@props([
    'message' => null,           // Message model
    'currentUserId' => null,     // auth()->id()
    'showAvatar' => true,        // apenas primeira da sequência do mesmo remetente
    'showName' => true,
])

<?php
$isOwn = $message->remetente_id == $currentUserId;
$isFile = $message->tipo_mensagem === 'arquivo';
?>

<div class="flex {{ $isOwn ? 'justify-end' : 'justify-start' }} gap-2">
    @if(!$isOwn && $showAvatar)
        <x-avatar :src="$message->remetente->url_avatar" :name="$message->remetente->nome_completo" size="xs" class="mt-1 flex-shrink-0" />
    @else
        <div class="w-8 flex-shrink-0"></div>
    @endif

    <div class="max-w-[70%] {{ $isOwn ? 'flex flex-col items-end' : 'flex flex-col items-start' }}">
        @if(!$isOwn && $showName)
            <p class="text-xs text-gray-500 mb-0.5">{{ $message->remetente->primeiro_nome }}</p>
        @endif

        <div class="{{ $isOwn ? 'bg-primary-500 text-white rounded-2xl rounded-tr-sm' : 'bg-gray-100 text-gray-900 rounded-2xl rounded-tl-sm' }} px-4 py-2 relative">
            @if($isFile)
                @if(str_starts_with($message->tipo_mensagem, 'image'))
                    <a href="{{ $message->url_arquivo }}" target="_blank" class="block">
                        <img src="{{ $message->url_arquivo }}" alt="{{ $message->nome_arquivo }}" class="max-w-xs max-h-64 rounded-lg">
                    </a>
                @else
                    <a href="{{ $message->url_arquivo }}" target="_blank" class="flex items-center gap-2 p-2 bg-white/50 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <div class="min-w-0">
                            <p class="font-medium truncate">{{ $message->nome_arquivo }}</p>
                            <p class="text-xs opacity-70">{{ number_format($message->tamanho_arquivo / 1024, 1) }} KB</p>
                        </div>
                    </a>
                @endif
            @else
                <p class="whitespace-pre-wrap">{{ $message->conteudo }}</p>
            @endif

            <div class="flex items-center justify-end gap-1.5 mt-1.5 text-xs opacity-60">
                <span>{{ $message->criado_em->format('H:i') }}</span>
                @if($isOwn)
                    @if($message->lida)
                        <svg class="w-4 h-4 text-white/70" fill="currentColor" viewBox="0 0 24 24"><path d="M18 7l-6 6 6 6"/></svg>
                    @else
                        <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7l-6 6 6 6"/></svg>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
```

---

## 3. Layout Components (Organismos)

### AppLayout (`layouts/app.blade.php`)

```blade
<!DOCTYPE html>
<html lang="pt-AO" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 flex flex-col" x-data="{ sidebarOpen: false }">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-2 w-80 pointer-events-none" x-data="@this">
        <template x-for="toast in $store.toast.toasts" :key="toast.id">
            <x-toast
                :id="toast.id"
                :type="toast.type"
                :title="toast.title"
                :message="toast.message"
                :duration="toast.duration"
                :action="toast.action"
            />
        </template>
    </div>

    <!-- Mobile Header -->
    <header class="lg:hidden fixed top-0 left-0 right-0 h-14 bg-white border-b border-gray-200 z-40 flex items-center justify-between px-4">
        <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-900 p-2" aria-label="Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="{{ url('/') }}" class="font-bold text-xl text-primary-700">Skilla</a>
        <div class="w-10"></div>
    </header>

    <!-- Sidebar Overlay (Mobile) -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:leave="transition-opacity ease-linear duration-200" class="fixed inset-0 z-40 bg-black/50 lg:hidden" @click="sidebarOpen = false" aria-hidden="true"></div>

    <!-- Sidebar -->
    <aside
        x-show="sidebarOpen"
        x-transition:enter="transition transform ease-out duration-200"
        x-transition:leave="transition transform ease-in duration-200"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 lg:relative lg:z-auto lg:block"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        aria-label="Navegação lateral"
    >
        <div class="flex flex-col h-full">
            <!-- Logo + Close (Mobile) -->
            <div class="flex items-center justify-between h-14 px-4 border-b border-gray-100 lg:hidden">
                <a href="{{ url('/') }}" class="font-bold text-xl text-primary-700">Skilla</a>
                <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-700" aria-label="Fechar menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto" aria-label="Navegação principal">
                @if(auth()->user()->funcao === 'cliente')
                    <x-nav.link href="{{ url('/painel/cliente') }}" icon="home" :active="request()->routeIs('painel.cliente*')">Dashboard</x-nav.link>
                    <x-nav.link href="{{ url('/painel/cliente/jobs') }}" icon="briefcase" :active="request()->routeIs('painel.cliente.jobs*')">Meus Jobs</x-nav.link>
                    <x-nav.link href="{{ url('/painel/cliente/propostas') }}" icon="inbox" :active="request()->routeIs('painel.cliente.propostas*')">Propostas Recebidas</x-nav.link>
                    <x-nav.link href="{{ url('/carteira') }}" icon="wallet" :active="request()->routeIs('carteira*')">Carteira</x-nav.link>
                    <x-nav.link href="{{ url('/definicoes') }}" icon="cog" :active="request()->routeIs('definicoes*')">Configurações</x-nav.link>
                @elseif(auth()->user()->funcao === 'freelancer')
                    <x-nav.link href="{{ url('/painel/freelancer') }}" icon="home" :active="request()->routeIs('painel.freelancer*')">Dashboard</x-nav.link>
                    <x-nav.link href="{{ url('/jobs') }}" icon="search" :active="request()->routeIs('jobs*')">Explorar Jobs</x-nav.link>
                    <x-nav.link href="{{ url('/proposals') }}" icon="paper-airplane" :active="request()->routeIs('proposals*')">Minhas Propostas</x-nav.link>
                    <x-nav.link href="{{ url('/painel/freelancer/trabalhos') }}" icon="folder" :active="request()->routeIs('painel.freelancer.trabalhos*')">Trabalhos</x-nav.link>
                    <x-nav.link href="{{ url('/carteira') }}" icon="wallet" :active="request()->routeIs('carteira*')">Carteira</x-nav.link>
                    <x-nav.link href="{{ url('/creditos/comprar') }}" icon="credit-card" :active="request()->routeIs('creditos*')">Créditos</x-nav.link>
                    <x-nav.link href="{{ url('/perfil') }}" icon="user" :active="request()->routeIs('perfil*')">Perfil</x-nav.link>
                    <x-nav.link href="{{ url('/definicoes') }}" icon="cog" :active="request()->routeIs('definicoes*')">Configurações</x-nav.link>
                @endif
            </nav>

            <!-- User Footer -->
            <div class="p-3 border-t border-gray-100 lg:hidden">
                <x-avatar :src="auth()->user()->url_avatar" :name="auth()->user()->nome_completo" size="sm" class="mx-auto mb-2" />
                <p class="text-center text-sm font-medium text-gray-900">{{ auth()->user()->nome_completo }}</p>
                <p class="text-center text-xs text-gray-500">@{{ auth()->user()->nome_usuario }}</p>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <x-button type="submit" variant="ghost" fullWidth size="sm">Sair</x-button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 lg:ml-0 min-h-screen pt-14 lg:pt-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer (opcional) -->
    @if(isset($showFooter) && $showFooter)
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Skilla. Todos os direitos reservados.
            </div>
        </footer>
    @endif

    <!-- Alpine Store para Toasts -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('toast', {
                toasts: [],
                add(type, title, message, options = {}) { /* ... */ },
                remove(id) { /* ... */ },
                success(t, m, o) { this.add('success', t, m, o); },
                error(t, m, o) { this.add('error', t, m, o); },
                warning(t, m, o) { this.add('warning', t, m, o); },
                info(t, m, o) { this.add('info', t, m, o); },
            });
        });
    </script>
</body>
</html>
```

---

## 4. Utilitários & Helpers

### Formatadores (PHP)
```php
// app/Helpers/Format.php
if (!function_exists('formatKz')) {
    function formatKz(float|int|string $value, bool $showSymbol = true): string
    {
        $formatted = number_format((float)$value, 2, ',', '.');
        return $showSymbol ? "{$formatted} Kz" : $formatted;
    }
}

if (!function_exists('formatDateBR')) {
    function formatDateBR($date, string $format = 'd/m/Y'): string
    {
        return $date ? \Carbon\Carbon::parse($date)->format($format) : '-';
    }
}

if (!function_exists('formatPhoneAO')) {
    function formatPhoneAO(string $phone): string
    {
        $clean = preg_replace('/\D/', '', $phone);
        if (strlen($clean) === 9) return '+244 ' . substr($clean, 0, 2) . ' ' . substr($clean, 2, 3) . ' ' . substr($clean, 5);
        if (strlen($clean) === 11 && str_starts_with($clean, '244')) return '+' . substr($clean, 0, 3) . ' ' . substr($clean, 3, 2) . ' ' . substr($clean, 5, 3) . ' ' . substr($clean, 8);
        return $phone;
    }
}
```

---

## 5. Guia de Uso & Convenções

### Nomenclatura
- **Arquivos**: `kebab-case` (`button.blade.php`, `job-card.blade.php`)
- **Props**: `camelCase` (`variant`, `wireModel`, `fullWidth`)
- **Slots**: `header`, `content`, `footer`, `default` (`$slot`)
- **CSS Classes**: Tailwind utilities; evitar CSS customizado exceto animações complexas

### Acessibilidade (Obrigatório)
- Todos inputs com `<label>` associado (`for` + `id`)
- `aria-label` em botões só ícone
- `aria-live="polite"` em toasts/notificações dinâmicas
- `role="alert"` em erros inline
- `focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2` em todos interativos
- Contraste ≥ 4.5:1 (textos), ≥ 3:1 (large text, UI components)

### Estado Vazio (Empty State)
```blade
<x-empty-state
    icon="inbox"
    title="Nenhuma proposta ainda"
    description="Quando você enviar propostas, elas aparecerão aqui."
    action={<x-button href="/jobs">Explorar Jobs</x-button>}
/>
```

### Loading States
```blade
<!-- Skeleton genérico -->
<x-skeleton class="h-4 w-3/4" />
<x-skeleton class="h-12 w-full rounded-lg" /> <!-- Card -->
<x-skeleton class="h-8 w-20 rounded" />    <!-- Button -->

<!-- Spinner overlay -->
<x-spinner size="md" class="absolute inset-0 flex items-center justify-center bg-white/80" />
```

---

## 6. Roadmap de Componentes (Futuro)

| Componente | Prioridade | Descrição |
|------------|------------|-----------|
| `DataTable` | Alta | Sort, paginação, seleção, actions coluna, server-side |
| `DatePicker` | Alta | Range, presets, localização pt-AO |
| `RichTextEditor` | Média | TipTap/Quill para descrição job |
| `FileDropzone` | Alta | Drag-drop, preview, progress, validação |
| `Select2/Combobox` | Alta | Busca, multi-select, create new, async |
| `Chart` | Média | ApexCharts wrapper (dashboard stats) |
| `Wizard/Stepper` | Alta | Validação por passo, progresso persistido |
| `Tour/Onboarding` | Baixa | Driver.js integration |
| `Tour/Tooltip` | Média | Tippy.js wrapper |

---

## Related docs
- [ui-plan.md](ui-plan.md)
- [screen-mapping.md](screen-mapping.md)
- [screen-specification.md](screen-specification.md)
- [../01-product/use-cases.md](../01-product/use-cases.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)
- [../05-design/screen-specification.md](../05-design/screen-specification.md)