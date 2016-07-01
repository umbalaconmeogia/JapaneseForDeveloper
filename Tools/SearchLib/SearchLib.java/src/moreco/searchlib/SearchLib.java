package moreco.searchlib;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import moreco.searchlib.splitword.SplitWord;

public class SearchLib {

    public static final String LANG_CODE_ENGLISH = "en";
    public static final String LANG_CODE_JAPANESE = "ja";

    /**
     * Search for a text in specified records. The result is sorted.
     * @param searchText
     * @param languageCode
     * @param searchDataRecords
     * @param maxResultNum Restrict the number of return result.
     *                     If set to null or zero, then return all result.
     * @return
     */
    public static List<SearchDataRecord> search(String searchText,
            String languageCode, List<SearchDataRecord> searchDataRecords, Integer maxResultNum) {

        // Split searchText into words.
        String[] searchWords = SplitWord.split(searchText, languageCode);

        // Search
        Map<SearchDataRecord, Integer> searchWeight = searchWeight(searchWords, searchDataRecords);

        // Sort by weight
        // TODO: if there are another elements with same weight of the last element, then return them, too.
        List<SearchDataRecord> result = getKeySortedByValue(searchWeight);
        if (maxResultNum != null && maxResultNum != 0) {
            result = result.subList(0, maxResultNum - 1);
        }

        return result;
    }

    private static Map<SearchDataRecord, Integer>
    searchWeight(String[] searchWords, List<SearchDataRecord> searchDataRecords) {
        Map<SearchDataRecord, Integer> searchWeight = new HashMap<SearchDataRecord, Integer>();
        for (int recordIndex = 0; recordIndex < searchDataRecords.size(); recordIndex++) {
            SearchDataRecord searchDataRecord = searchDataRecords.get(recordIndex);

            int count = 0;
            for (int wordIndex = 0; wordIndex < searchWords.length; wordIndex++) {
                count += countOccurrences(searchWords[wordIndex], searchDataRecord.getSearchData());
            }

            // Use negative value of count for sorting in the next step.
            searchWeight.put(searchDataRecord, count);
        }

        return searchWeight;
    }

    private static <K, V extends Comparable<? super V>>
    List<K> getKeySortedByValue(Map<K, V> map)
    {
        List<Map.Entry<K, V>> list =
            new ArrayList<Map.Entry<K, V>>(map.entrySet());
        // Sort by inverse order.
        Collections.sort(list, new Comparator<Map.Entry<K, V>>() {
            @Override
            public int compare(Map.Entry<K, V> o1, Map.Entry<K, V> o2)
            {
                return -(o1.getValue()).compareTo(o2.getValue());
            }
        });

        List<K> result = new ArrayList<K>();
        for (Map.Entry<K, V> entry : list)
        {
//            System.out.println(entry.getValue() + ": " + ((SearchDataRecord)entry.getKey()).getSearchData());
            result.add(entry.getKey());
        }
        return result;
    }


    /**
     * Count occurrences of a string in a text.
     * @param findStr
     * @param text
     * @return
     */
    private static int countOccurrences(String findStr, String text) {
        int lastIndex = 0;
        int count = 0;

        while (lastIndex != -1){

            lastIndex = text.indexOf(findStr, lastIndex);

            if(lastIndex != -1){
                count ++;
                lastIndex += findStr.length();
            }
        }

        return count;
    }
}
