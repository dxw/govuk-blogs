/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
const {
  __
} = wp.i18n;
const {
  addFilter
} = wp.hooks;
const {
  createHigherOrderComponent
} = wp.compose;
const {
  Fragment,
  cloneElement
} = wp.element;
const {
  InspectorControls
} = wp.editor;
const {
  PanelBody,
  ToggleControl
} = wp.components;
function wrapCoverBlockInContainer(element, blockType, attributes) {
  // skip if element is undefined

  if (!element) {
    return;
  }

  // only apply to cover blocks
  if (blockType.name !== 'core/button') {
    return element;
  }
  console.log(element.props.children);
  if (element.props.children) {
    return cloneElement(element, {}, cloneElement(element.props.children, {
      className: 'govuk-button'
    }));
  }
}
wp.hooks.addFilter('blocks.getSaveElement', 'my-plugin/wrap-cover-block-in-container', wrapCoverBlockInContainer);
/******/ })()
;
//# sourceMappingURL=index.js.map