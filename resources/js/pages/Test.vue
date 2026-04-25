<script>

</script>

<template>
    <h1>Hello world</h1>
    <Vueform>
        <StaticElement name="h1" tag="h1" content="Officer Create Form" align="left" :expressions="true"
            description="Input all * field" />
        <TextElement name="text" label="Short text" />
        <TextElement name="number" input-type="number" :rules="[
            'nullable',
            'numeric',
        ]" autocomplete="off" label="Number" />
        <TextElement name="email" input-type="email" :rules="[
            'nullable',
            'email',
        ]" label="Email" />
        <PhoneElement name="phone" label="Phone" :allow-incomplete="true" :unmask="true" />
        <CheckboxgroupElement name="checkboxgroup" :items="[
            'Option 1',
            'Option 2',
            'Option 3',
        ]" label="Multiple choice" />
        <RadiogroupElement name="radiogroup" :items="[
            'Option 1',
            'Option 2',
            'Option 3',
        ]" label="Single choice" />
        <CheckboxElement name="checkbox" text="Decision box" />
        <MatrixElement name="matrix" :cols="[
            {
                label: 'Column 1',
                value: 'column_1',
            },
            {
                label: 'Column 2',
                value: 'column_2',
            },
        ]" :rows="[
            {
                label: 'Row 1',
                value: 'row_1',
            },
            {
                label: 'Row 2',
                value: 'row_2',
            },
        ]" />
        <MatrixElement name="matrixMulti" :cols="[
            {
                label: 'Column 1',
                value: 'column_1',
            },
            {
                label: 'Column 2',
                value: 'column_2',
            },
        ]" :rows="[
            {
                label: 'Row 1',
                value: 'row_1',
            },
            {
                label: 'Row 2',
                value: 'row_2',
            },
        ]" :input-type="{
            type: 'checkbox',
        }" />
        <SelectElement name="select" :items="[
            'Option 1',
            'Option 2',
            'Option 3',
        ]" :search="true" :native="false" :strict="false" label="Dropdown" input-type="search" autocomplete="off" />
        <TagsElement name="tags" :close-on-select="false" :search="true" :strict="false" :hide-selected="false" :items="[
            'Option 1',
            'Option 2',
            'Option 3',
        ]" label="Tags" input-type="search" autocomplete="off" />
        <ToggleElement name="toggle" text="Toggle" />
        <DateElement name="date" label="Date" display-format="DD/MM/YYYY" />
        <DatesElement name="dateRange" label="Date range" mode="range" />
        <TextElement name="url" input-type="url" :rules="[
            'nullable',
            'url',
        ]" placeholder="eg. http(s)://domain.com" :floating="false" label="URL" />
        <LocationElement name="location" label="Location" />
        <FileElement name="image" view="image" label="Image upload" accept="image/*" :upload-temp-endpoint="false"
            :remove-temp-endpoint="false" :remove-endpoint="false" :clickable="false" :soft-remove="true" />
        <MultifileElement name="multifile" label="Multi-file upload" :upload-temp-endpoint="false"
            :remove-temp-endpoint="false" :remove-endpoint="false" :clickable="false" :soft-remove="true"
            :sort="true" />
    </Vueform>
</template>