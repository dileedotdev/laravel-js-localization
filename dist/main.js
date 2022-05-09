// window._jsLocalization will be defined before this file is loaded

/**
 * Get translation from locale, key pair
 *
 * @param {string} key
 * @param {string|null} locale
 * @returns {string}
 */
window._jsLocalization.getTranslation = function (key, locale = null) {
    return (
        this.langs?.[locale]?.[key] ||
        this.langs?.[this.locale]?.[key] ||
        this.langs?.[this.fallbackLocale]?.[key] ||
        key
    );
};

/**
 * Replace translation with replaces
 *
 * @param {string} translation
 * @param {Record<string,string>} replaces
 * @returns {string}
 */
window._jsLocalization.replace = function (translation, replaces = {}) {
    Object.keys(replaces).forEach((r) => {
        translation = translation.replaceAll(`:${r}`, replaces[r]);
    });

    return translation.trim();
};

/**
 * Translate a string
 *
 * @param {string} key
 * @param {Record<string,string>} replaces
 * @param {string|null} locale
 * @returns {string}
 */
window._jsLocalization.trans = function (key, replaces = {}, locale = null) {
    let translation = window._jsLocalization.getTranslation(key, locale);

    return window._jsLocalization.replace(translation, replaces);
};

window.trans = window._jsLocalization.trans;
window.__ = window._jsLocalization.trans;

/**
 * Translate a string support choice result
 *
 * @param {string} key
 * @param {number} number
 * @param {Record<string,string>} replaces
 * @param {string|null} locale
 * @returns {string}
 */
window._jsLocalization.transChoice = function (
    key,
    number,
    replaces = {},
    locale = null
) {
    let translation = window._jsLocalization.getTranslation(key, locale);

    let parts = translation.split("|");

    translation = parts
        .map((part, i) => {
            let match;

            if ((match = /^{([\d,]+)}/.exec(part))) {
                return {
                    translation: part.replace(match[0], "").trimStart(),
                    set: match[1].split(",").map((n) => parseInt(n)),
                };
            }

            if ((match = /^\[([\d,\*]+)]/.exec(part))) {
                let range = {};
                let pair = match[1].split(",");

                if (pair.length !== 2) {
                    console.error(
                        `"${translation}" is not a valid choice translation [laravel-js-localization]`
                    );
                    return {
                        translation: part.replace(match[0], "").trimStart(),
                    };
                }

                if (pair[0] !== "*") {
                    range.min = parseInt(pair[0]);
                }

                if (pair[1] !== "*") {
                    range.max = parseInt(pair[1]);
                }

                return {
                    translation: part.replace(match[0], "").trimStart(),
                    range: range,
                };
            }

            if (i === 0) {
                return {
                    translation: part,
                    set: [1],
                };
            }

            return {
                translation: part,
                unset: [1],
            };
        })
        .find((part) => {
            let result = true;

            if (part.set) result = result && part.set.includes(number);
            if (part.unset) result = result && !part.unset.includes(number);
            if (part.range?.min) result = result && number >= part.range.min;
            if (part.range?.max) result = result && number <= part.range.max;

            return result;
        })?.translation;

    translation ??= parts[0];

    return window._jsLocalization.replace(translation, replaces);
};

window.transChoice = window._jsLocalization.transChoice;
