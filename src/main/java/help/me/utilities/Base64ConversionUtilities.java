package help.me.utilities;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.nio.ByteBuffer;
import java.util.ArrayList;

import org.apache.commons.codec.binary.Base64InputStream;

public class Base64ConversionUtilities {

	/**
	 * Reads the contents of inputStream and will either encode or decode, based on the doEncode flag.
	 * @param inputStream
	 * @param doEncode
	 * @return byte data that has been encoded or decoded.
	 * @throws IOException
	 */
	public static ByteBuffer getContents(InputStream inputStream, boolean doEncode) throws IOException {
		ArrayList<ByteBuffer> bytes = new ArrayList<ByteBuffer>();
		
		int totalBytes = 0;
		try (Base64InputStream is = new Base64InputStream(inputStream, doEncode) ) {
			int bytesRead;
			do {
				byte[] b = new byte[4096];
				bytesRead = is.read(b);
				
				if (bytesRead > 0) {
					totalBytes += bytesRead;
					bytes.add(ByteBuffer.wrap(b, 0, bytesRead));
				}
			} while (bytesRead > 0);
		}

		// Create a master ByteBuffer add the old and return the resulting array.
		ByteBuffer bb = ByteBuffer.allocate(totalBytes);
		bytes.forEach(byteBuffer -> bb.put(byteBuffer));
		
		return bb;
	}

	/**
	 * Encode the contents of the stream.
	 * 
	 * @param inputStream
	 * @return encoded byte data
	 * @throws IOException 
	 */
	public static ByteBuffer encodeContents(InputStream inputStream) throws IOException {
		return getContents(inputStream, true);
	}
	
	/**
	 * Base64 encodes the contents of the file.  Beware, this will 
	 * read in the entire contents of the file to do the 
	 * encoding.  If the file is too big that is on you!  Should 
	 * only be used for small-ish files. 
	 * 
	 * @param file File to have the contents encoded
	 * @return encoded byte data
	 * @throws FileNotFoundException
	 * @throws IOException
	 */
	public static ByteBuffer encodeContents(File file) throws FileNotFoundException, IOException {
		try (FileInputStream fis = new FileInputStream(file)) {
			return encodeContents(fis);
		}
	}
	
	/**
	 * Decodes the contents of the stream.
	 * 
	 * @param inputStream
	 * @param length
	 * @return decoded byte data
	 * @throws IOException 
	 */
	public static ByteBuffer decodeContents(InputStream inputStream) throws IOException {
		return getContents(inputStream, false);
	}
	
	/**
	 * Base64 decodes the contents in file.
	 * 
	 * @param file File to have the contents decoded
	 * @return decoded byte data
	 * @throws FileNotFoundException
	 * @throws IOException
	 */
	public static ByteBuffer decodeContents(File file) throws FileNotFoundException, IOException {
		try (FileInputStream fis = new FileInputStream(file)) {
			return decodeContents(fis);
		}
	}
	
	/**
	 * Decodes the contents in file and turns them to a string.
	 * 
	 * @param file
	 * @return
	 * @throws FileNotFoundException
	 * @throws IOException
	 */
	public static String  getEncodeContentsString(File file) throws FileNotFoundException, IOException {
		ByteBuffer buffer = encodeContents(file);
		return new String(buffer.array());
	}
}
