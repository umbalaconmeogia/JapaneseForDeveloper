package moreco.searchlib.splitword;

class SplitEngineEnglish implements SplitEngine {

    @Override
    public String[] split(String text) {
        String[] result = null;
        
        if (text != null) {
            result = text.split("\\s+");
        }
        return result;
    }
    
    @Override
    public boolean isUsableWord(String word) {
        return word.length() > 2;
    }
}
