package help.me.orm.entity;

import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-05-12T21:55:41.588-0700")
@StaticMetamodel(Info.class)
public class Info_ {
	public static volatile SingularAttribute<Info, Integer> infoId;
	public static volatile SingularAttribute<Info, User> user;
	public static volatile SingularAttribute<Info, String> address;
	public static volatile SingularAttribute<Info, String> businessName;
	public static volatile SingularAttribute<Info, String> city;
	public static volatile SingularAttribute<Info, String> zipcode;
	public static volatile SingularAttribute<Info, String> phoneNumber;
	public static volatile SingularAttribute<Info, Boolean> phoneOk;
	public static volatile SingularAttribute<Info, Boolean> textOk;
	public static volatile SingularAttribute<Info, Boolean> emailOk;
	public static volatile SingularAttribute<Info, Long> createdAt;
	public static volatile SingularAttribute<Info, Long> updatedAt;
}
