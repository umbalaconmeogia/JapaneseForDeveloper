package moreco.searchlib.splitword;

public interface SplitEngine {

    /**
     * Split text into words.
     * @param text
     * @return
     */
    public String[] split(String text);
    
    /**
     * Check a word can be used for searching.
     * For example, a, an, in... in English has no meaning.
     * @param word
     * @return
     */
    public boolean isUsableWord(String word);
}
