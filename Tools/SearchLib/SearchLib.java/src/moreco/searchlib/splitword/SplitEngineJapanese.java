package moreco.searchlib.splitword;

import java.io.IOException;
import java.io.StringReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import com.chauhai.batsg.util.StringUtil;

import net.moraleboost.io.BasicCodePointReader;
import net.moraleboost.tinysegmenter.TinySegmenter;

class SplitEngineJapanese implements SplitEngine {

    /**
     * List of words that are used to search.
     */
    private static final List<String> DONT_SEARCH_WORDS = Arrays.asList(new String[] {"が", "に", "は", "を", "へ", "で"});

    @Override
    public String[] split(String text) {
        StringReader reader = new StringReader(StringUtil.removeSpace(text));
        BasicCodePointReader cpreader = new BasicCodePointReader(reader);

        TinySegmenter segmenter = new TinySegmenter(cpreader);
        TinySegmenter.Token token;
        List<String> result = new ArrayList<String>();
        try {
            while ((token = segmenter.next()) != null) {
                result.add(token.str);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return result.toArray(new String[0]);
    }

    @Override
    public boolean isUsableWord(String word) {
        boolean result = (word.length() > 1 || !DONT_SEARCH_WORDS.contains(word));
//        if (!result) System.out.println("ignore " + word);
        return result;
    }
}
