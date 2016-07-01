package moreco.searchlib.splitword;

import java.util.ArrayList;
import java.util.List;

import moreco.searchlib.SearchLib;

/**
 * Split text into words used for searching.
 */
public class SplitWord {

    /**
     * Split a text in specified language into words.
     * @param text Text to be split.
     * @param languageCode Code that this library is compatible. E.g: "en", "jp", "vn"...
     * @return
     */
    public static String[] split(String text, String languageCode) {
        SplitEngine splitEngine = getSplitEngine(languageCode);
        String[] words = splitEngine.split(text);

        List<String> result = new ArrayList<String>();
        for (int i = 0; i < words.length; i++) {
            if (splitEngine.isUsableWord(words[i])) {
                result.add(words[i]);
            }
        }
        return result.toArray(new String[0]);
    }

    /**
     * Create a SplitEngline object for specified language code.
     * @param languageCode "en", "jp", "vn"...
     * @return
     */
    private static SplitEngine getSplitEngine(String languageCode) {
        SplitEngine result = null;

        // Create result (SearchEngline) by languageCode.
        if (languageCode != null) {
            if (languageCode.equals(SearchLib.LANG_CODE_ENGLISH)) {
                result = new SplitEngineEnglish();
            } else if (languageCode.equals(SearchLib.LANG_CODE_JAPANESE)) {
                result = new SplitEngineJapanese();
            }
        }

        // If languageCode is not compatible, then return SearchEngineEnglish by default.
        if (result == null) {
            result = new SplitEngineEnglish();
        }

        return result;
    }
}
