/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

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
function changeClassOfInnerElement(element, blockType, attributes) {
  // skip if element is undefined

  if (!element) {
    return;
  }

  // only apply to cover blocks
  if (blockType.name !== 'core/button') {
    return element;
  }

  // console.log(element.props.children.value)
  if (element.props.children) {
    return cloneElement(element, {}, cloneElement(element.props.children, {
      ...element.props,
      className: 'govuk-button'
      // value: buttonValue + 'orange'
    }));
  }
}

// function changeClassOfInnerElement( props )
// {

// 	if (props.className !== 'wp-block-button') {
// 		return props;
// 	}
// 	console.log(props)
// 	return {
// 		...props,
// 		className: 'govuk-button'
// 	}
// }

wp.hooks.addFilter('blocks.getSaveElement', 'my-plugin/wrap-cover-block-in-container', changeClassOfInnerElement);
function addClassNameForValidation(props) {
  console.log(props);
  // if (props.type !== "button" ) {
  // 	return props;
  // }

  // props.className = 'govuk-button'

  return props;
}

// wp.hooks.addFilter(
//     'editor.BlockEdit',
//     'my-plugin/with-inspector-controls',
//     addClassNameForValidation
// );

// // Our filter function
// function setBlockCustomClassName( className, blockName ) {
// 	console.log(className, blockName)
//     // return className === 'wp-block-button__link' ? 'govuk-button' : className;
// 	return className
// }

// // Adding the filter
// wp.hooks.addFilter(
//     'blocks.getBlockDefaultClassName',
//     'my-plugin/set-block-custom-class-name',
//     setBlockCustomClassName
// );

const withSubscribeBanner = createHigherOrderComponent(BlockEdit => {
  return props => {
    if (props.name !== 'core/button') {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockEdit, {
        ...props
      });
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockEdit, {
      ...props,
      className: "govuk-buton"
    }));
  };
}, 'withSubscribeBanner');
addFilter('editor.BlockEdit', 'mle-block-library/embed-subscribe-edit', withSubscribeBanner);
})();

/******/ })()
;
//# sourceMappingURL=index.js.map