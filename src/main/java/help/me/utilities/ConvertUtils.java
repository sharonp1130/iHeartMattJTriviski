package help.me.utilities;

import java.util.ArrayList;
import java.util.Collection;
import java.util.Collections;
import java.util.TreeSet;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.apache.log4j.Logger;

public class ConvertUtils {
	private static final Pattern rangePattern = Pattern.compile("(\\d+?)\\.\\.(\\d+?)");
	private static Logger log = Logger.getLogger(ConvertUtils.class);


	/**
	 * Calls convertRange of ranges and converts the values to integers.  If the strings are larger than int values
	 * the values will be truncated.  This does no verification to make sure the values are int sized.
	 * 
	 * @param ranges strings to convert
	 * @return collection of converted values as integers.
	 */
	public static Collection<Integer> convertRangeInt(Collection<String> ranges) {
		if (ranges == null || ranges.isEmpty()) {
			return Collections.<Integer>emptyList();
		} else {
			Collection<Integer> intConverted = new ArrayList<Integer>();
			
			for (Long value : convertRange(ranges)) {
				intConverted.add(value.intValue());
			}
			
			return intConverted;
		}
	}
	
	/**
	 * Calls convertRange of ranges and converts the values to bytes.  If the strings are larger than byte values
	 * the values will be truncated.  This does no verification to make sure the values are byte sized.
	 * 
	 * @param ranges strings to convert
	 * @return collection of converted values as Bytes.  Values out of range will be truncated.
	 */
	public static Collection<Byte> convertRangeBytes(Collection<String> ranges) {
		if (ranges == null || ranges.isEmpty()) {
			return Collections.<Byte>emptyList();
		} else {
			Collection<Byte> byteConverted = new ArrayList<Byte>();
			
			for (Long value : convertRange(ranges)) {
				byteConverted.add(value.byteValue());
			}
			
			return byteConverted;
		}
	}
	
	/**
	 * Converts a set of integer / long string values including range strings to a fully realized list of longs.
	 * Range string: 1..10 would be converted to [1,2,3,4,5,6,7,8,9,10].
	 * 
	 * @param ranges strings to convert
	 * @return collection of converted values as longs.
	 */
	public static Collection<Long> convertRange(Collection<String> ranges) {
		if (ranges == null || ranges.isEmpty()) {
			return Collections.<Long>emptyList();
		} else {
			Collection<Long> converted = new TreeSet<Long>();
			
			for (String range : ranges) {
				Matcher matcher = rangePattern.matcher(range);
				
				if (matcher.matches()) {
					// This is a range string.
					long lower = Long.valueOf(matcher.group(1));
					long upper = Long.valueOf(matcher.group(2));
					
					if (lower > upper) {
						log.error(String.format("Range invalid: lower=%d upper=%d", lower, upper));
					} else {
						for (long r = lower; r <= upper; r++) {
							converted.add(r);
						}
					}
					
				} else if (range.matches("\\d+")) {
					// This is a single number value.
					converted.add(Long.valueOf(range));
				} else {
					/**
					 * Bogus value.  
					 */
					log.warn("Value is neither a range or an integer and will be thrown out: " + range);
				}
			}
			
			return converted;
		}
	}
}