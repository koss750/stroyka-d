@props(['groupName', 'options', 'label'])
<script>
var selectedOptions = {
        foundation: '',
        dd: '',
        roof: ''
    };

    var selectedOptionRefs = {
        foundation: 220,
        dd: 328,
        roof: 222
    };

    var selectedOptionPrices = {
        foundation: 0,
        dd: 999,
        roof: 0
    };

function updateSelectedOption(element, optionType, parent) {
    var currentSelection = document.getElementById(optionType + '_' + selectedOptionRefs[optionType]);
    if (currentSelection) {
        currentSelection.checked = false;
    }
    var titleLabel = element.getAttribute('data-title-label');
    var price = parseFloat(element.getAttribute('data-price'));
    var ref = element.getAttribute('data-ref');
    var newSelection = document.getElementById(optionType + '_' + ref);
    if (newSelection) {
        newSelection.checked = true;
    }

    // Update the global variables
    selectedOptions[optionType] = titleLabel;
    selectedOptionRefs[optionType] = ref;
    selectedOptionPrices[optionType] = price;

    // Update the UI
    document.getElementById('title_label_' + optionType).textContent = titleLabel;
    toggleOptions(parent, '', optionType);
    calculateTotalPrice();
}

function calculateTotalPrice() {
    let total = 0;
    for (let optionType in selectedOptionPrices) {
        total += selectedOptionPrices[optionType];
    }
    //separate thousands
    total = total.toFixed();
    document.getElementById('totalPrice').textContent = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

function toggleOptions(ref, defaultSelection = '', groupName) {
    var optionGroup = document.getElementById(groupName + '_option_group');
    var suboptions = document.getElementById('suboptions_' + ref);
    // Hide all suboptions in this option group
    var allSuboptions = optionGroup.querySelectorAll('.suboptions');
    allSuboptions.forEach(function(suboption) {
        suboption.style.display = 'none';
    });

    // Show the selected option's suboptions if they exist
    if (suboptions) {
        suboptions.style.display = 'block';
    }

    if (defaultSelection) {
        var defaultOption = document.getElementById('label_' + defaultSelection);
        var defaultOptionRef = document.getElementById(groupName + '_' + defaultSelection);
        if (defaultOption) {
            defaultOption.click();
            defaultOptionRef.checked = true;
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize with default values
    for (let optionType in selectedOptionRefs) {
        let defaultElement = document.querySelector(`[data-ref="${selectedOptionRefs[optionType]}"]`);
        if (defaultElement) {
            updateSelectedOption(defaultElement, optionType, defaultElement.getAttribute('data-ref'));
        }
    }
});
</script>
<div class="option-group" id="{{ $groupName }}_option_group">
    <label class="btn btn-outline-light title-btn" id="title_label_{{ $groupName }}" disabled>{{ $label }}</label>
    <!-- Level 2: Main options -->
    <div class="btn-group main-options" role="group" aria-label="{{ $groupName }} button group">
        @foreach($options as $option)
            <input type="radio" class="btn-check" name="{{ $groupName }}" id="{{ $groupName }}_{{ $option->ref }}" autocomplete="off">
            <label class="btn btn-outline-light {{ $groupName }}-label" 
                for="{{ $groupName }}_{{ $option->ref }}" 
                @if($option->suboptions->isNotEmpty())
                    onclick="toggleOptions('{{ $option->ref }}', '{{ $option->unique_default ?? '' }}', '{{ $groupName }}')"
                @else
                    onclick="updateSelectedOption(this, '{{ $groupName }}', '{{ $option->ref }}')"
                    data-ref="{{ $option->ref }}"
                    data-title-label="{{ $option->site_tab_label . ' - ' . $option->site_label }}"
                    data-price="{{ $option->data_price ?? 0 }}"
                @endif
            >{{ $option->site_label }}</label>
        @endforeach
    </div>
    <div class="suboptions-container">
        @foreach($options as $option)
            @if($option->suboptions->isNotEmpty())
                <div class="suboptions" id="suboptions_{{ $option->ref }}" style="display: none;">
                    <div class="simple-options-{{ $groupName }}">
                        @foreach($option->suboptions as $suboption)
                            @if($suboption->suboptions->isEmpty())
                                <input type="radio" class="btn-check" name="sub{{ $groupName }}" id="{{ $groupName }}_{{ $suboption->ref }}" autocomplete="off">
                                <label id="label_{{ $suboption->ref }}" class="btn btn-outline-light" data-ref="{{ $suboption->ref }}" data-title-label="{{ $option->site_tab_label . ' - ' . $option->site_label . ' - ' . $suboption->site_sub_label}}" data-price="{{ $suboption->data_price }}" for="{{ $groupName }}_{{ $suboption->id }}" onclick="updateSelectedOption(this, '{{ $groupName }}', {{ $option->ref }})">{{ $suboption->site_sub_label }}</label>
                            @else
                                <div class="wood-type-row">
                                    <div class="wood-type">
                                        <input type="radio" class="btn-check" name="sub{{ $groupName }}" id="{{ $groupName }}_{{ $suboption->ref }}" autocomplete="off">
                                        <label id="label_{{ $suboption->ref }}" class="btn btn-outline-light btn-wood wood-type-label" data-ref="{{ $suboption->ref }}" id="{{ $groupName }}label_{{ $suboption->id }}">{{ $suboption->site_sub_label }}</label>
                                    </div>
                                    <div class="sizes">
                                        @foreach($suboption->suboptions as $subsuboption)
                                            <input type="radio" class="btn-check" name="subsub{{ $groupName }}" id="{{ $groupName }}_{{ $subsuboption->ref }}" autocomplete="off">
                                            <label id="label_{{ $subsuboption->ref }}" class="btn btn-outline-light" data-ref="{{ $subsuboption->ref }}" data-title-label="{{ $option->site_tab_label . ' - ' . $option->site_label . ' - ' . $suboption->site_sub_label . ' - ' . $subsuboption->site_level4_label}}" data-price="{{ $subsuboption->data_price }}" for="{{ $groupName }}_{{ $subsuboption->id }}" onclick="updateSelectedOption(this, '{{ $groupName }}', {{ $option->ref }})">{{ $subsuboption->site_level4_label }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>