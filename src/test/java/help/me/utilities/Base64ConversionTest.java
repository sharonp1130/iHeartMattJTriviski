package help.me.utilities;

import static org.junit.Assert.*;

import java.io.ByteArrayInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.nio.ByteBuffer;

import org.junit.Test;

public class Base64ConversionTest {

	@Test
	public void testBase64() throws FileNotFoundException, IOException {
		File icon = new File("/Users/triviski/help-me/help-me-spring/src/main/resources/img/lightning.png");
		ByteBuffer orig = ByteBuffer.allocate((int) icon.length());
		
		try (FileInputStream is = new FileInputStream(icon)) {
			int br = is.read(orig.array());
			
			assertEquals(icon.length(), br);
		}
		
		ByteBuffer encoded = Base64ConversionUtilities.encodeContents(icon);
		ByteBuffer decoded = Base64ConversionUtilities.decodeContents(new ByteArrayInputStream(encoded.array()));
		
		decoded.rewind();
		assertEquals(orig, decoded);
		
		//System.out.println(Base64ConversionUtilities.getEncodeContentsString(icon));
	}
}
