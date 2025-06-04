panel.plugin("yvw/custom-blocks", {
  blocks: {
    box: {
      computed: {
        textField() {
          return this.field("text");
        }
      },
      template: `
        <div :class="'k-block-type-box box-' + content.boxtype">
          <k-writer
            class="label"
            ref="textbox"
            :marks="textField.marks"
            :value="content.text"
            :placeholder="textField.placeholder || 'Enter some stuff…'"
            @input="update({ text: $event })"
          />
        </div>
      `
    }
  }
});