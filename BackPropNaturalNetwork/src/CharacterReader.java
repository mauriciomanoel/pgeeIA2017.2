

import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;

public class CharacterReader {

	public static void readImage() throws IOException {

		BufferedImage image = ImageIO.read(new File("C:\\temp\\12219573_10208074742010514_1534603964773001927_n.jpg"));
		byte[][] pixels = new byte[image.getWidth()][];
		System.out.print("new int[] {");
		for (int x = 0; x < image.getWidth(); x++) {
			pixels[x] = new byte[image.getHeight()];

			for (int y = 0; y < image.getHeight(); y++) {
//				System.out.println(image.getRGB(x, y));
				pixels[x][y] = (byte) (image.getRGB(x, y) == 0xFFFFFFFF ? 0 : 1);
				System.out.print(pixels[x][y]+",");
			}
			
			
		}System.out.print("},");
		
	}
	
	public static void main(String[] args) throws IOException {
		
		readImage();
		
	}
}
